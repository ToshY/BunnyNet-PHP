<?php

declare(strict_types=1);

use ToshY\BunnyNet\Generator\Generator\MapGenerator;
use ToshY\BunnyNet\Generator\Utils\FileUtils;
use ToshY\BunnyNet\Model\Api\Base\AbuseCase\CheckAbuseCase;
use ToshY\BunnyNet\Model\Api\Base\AbuseCase\GetAbuseCase;
use ToshY\BunnyNet\Model\Api\Base\AbuseCase\GetDmcaCase;
use ToshY\BunnyNet\Model\Api\Base\AbuseCase\ListAbuseCases;
use ToshY\BunnyNet\Model\Api\Base\AbuseCase\ResolveAbuseCase;
use ToshY\BunnyNet\Model\Api\Base\AbuseCase\ResolveDmcaCase;
use ToshY\BunnyNet\Model\Api\Base\Auth\AuthJwt2fa;
use ToshY\BunnyNet\Model\Api\Base\Auth\RefreshJwt;
use ToshY\BunnyNet\Model\Api\Base\Billing\ApplyPromoCode;
use ToshY\BunnyNet\Model\Api\Base\Billing\ClaimAffiliateCredits;
use ToshY\BunnyNet\Model\Api\Base\Billing\ConfigureAutoRecharge;
use ToshY\BunnyNet\Model\Api\Base\Billing\CreateCoinifyPayment;
use ToshY\BunnyNet\Model\Api\Base\Billing\CreatePaymentCheckout;
use ToshY\BunnyNet\Model\Api\Base\Billing\GetAffiliateDetails;
use ToshY\BunnyNet\Model\Api\Base\Billing\GetBillingDetails;
use ToshY\BunnyNet\Model\Api\Base\Billing\GetBillingSummary;
use ToshY\BunnyNet\Model\Api\Base\Billing\GetBillingSummaryPDF;
use ToshY\BunnyNet\Model\Api\Base\Billing\GetCoinifyBitcoinExchangeRate;
use ToshY\BunnyNet\Model\Api\Base\Billing\PreparePaymentAuthorization;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\DismissDnsConfigurationNotice;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\RecheckDnsConfiguration;
use ToshY\BunnyNet\Model\Api\Base\DrmCertificate\ListDrmCertificates;
use ToshY\BunnyNet\Model\Api\Base\Purge\PurgeUrlByHeader;
use ToshY\BunnyNet\Model\Api\Base\Search\GlobalSearch;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\GetStorageZoneConnections;
use ToshY\BunnyNet\Model\Api\Base\Support\CloseTicket;
use ToshY\BunnyNet\Model\Api\Base\Support\CreateTicket;
use ToshY\BunnyNet\Model\Api\Base\Support\GetTicketDetails;
use ToshY\BunnyNet\Model\Api\Base\Support\ListTickets;
use ToshY\BunnyNet\Model\Api\Base\Support\ReplyTicket;
use ToshY\BunnyNet\Model\Api\Base\User\AcceptDpa;
use ToshY\BunnyNet\Model\Api\Base\User\CloseAccount;
use ToshY\BunnyNet\Model\Api\Base\User\DisableTwoFactorAuthentication;
use ToshY\BunnyNet\Model\Api\Base\User\EnableTwoFactorAuthentication;
use ToshY\BunnyNet\Model\Api\Base\User\GenerateTwoFactorAuthenticationVerification;
use ToshY\BunnyNet\Model\Api\Base\User\GetDpaDetails;
use ToshY\BunnyNet\Model\Api\Base\User\GetDpaDetailsHtml;
use ToshY\BunnyNet\Model\Api\Base\User\GetHomeFeed;
use ToshY\BunnyNet\Model\Api\Base\User\GetUserDetails;
use ToshY\BunnyNet\Model\Api\Base\User\GetWhatsNewItems;
use ToshY\BunnyNet\Model\Api\Base\User\ListCloseAccountReasons;
use ToshY\BunnyNet\Model\Api\Base\User\ListNotifications;
use ToshY\BunnyNet\Model\Api\Base\User\ResendEmailConfirmation;
use ToshY\BunnyNet\Model\Api\Base\User\ResetApiKey;
use ToshY\BunnyNet\Model\Api\Base\User\ResetWhatsNew;
use ToshY\BunnyNet\Model\Api\Base\User\SetNotificationsOpened;
use ToshY\BunnyNet\Model\Api\Base\User\UpdateUserDetails;
use ToshY\BunnyNet\Model\Api\Base\User\VerifyTwoFactorAuthenticationCode;

require_once __DIR__ . '/../../vendor/autoload.php';

$apiSpecManifest = getenv('API_SPEC_MANIFEST');
$modelInputDirectory = __DIR__ . '/../../src/Model/Api';
$outputDirectory = __DIR__ . '/../Map';

$file = FileUtils::getFile($apiSpecManifest);
if ($file === false) {
    throw new RuntimeException(
        sprintf(
            'Unable to load API spec file `%s`.',
            $apiSpecManifest,
        ),
    );
}
$manifests = FileUtils::jsonDecode($file);

$data = [];
foreach ($manifests as $file) {
    $description = $file['sourceDescription'];
    $key = match (true) {
        str_contains($description, 'bunny.net API') => \ToshY\BunnyNet\Enum\Generator::BASE->value,
        str_contains($description, 'Edge Scripting API') => \ToshY\BunnyNet\Enum\Generator::EDGE_SCRIPTING->value,
        str_contains($description, 'Edge Storage API') => \ToshY\BunnyNet\Enum\Generator::EDGE_STORAGE->value,
        str_contains($description, 'Stream API') => \ToshY\BunnyNet\Enum\Generator::STREAM->value,
        str_contains($description, 'Shield API') => \ToshY\BunnyNet\Enum\Generator::SHIELD->value,
        default => throw new RuntimeException(
            sprintf(
                'Unknown API type with description: `%s`',
                $description,
            ),
        ),
    };

    $ignoreEndpoints = match ($key) {
        \ToshY\BunnyNet\Enum\Generator::BASE->value => [
            /* Changed to EdgeScripting */
            '/compute/script',
            '/compute/script/{id}',
            '/compute/script/{id}/code',
            '/compute/script/{id}/releases',
            '/compute/script/{id}/publish',
            '/compute/script/{id}/publish/{uuid}',
            '/compute/script/{id}/variables/add',
            '/compute/script/{id}/variables/{variableId}',
        ],
        default => [],
    };

    // Endpoints that are still available to use but no longer in the OpenAPI specs
    $keepUndocumentedEndpoints = match ($key) {
        \ToshY\BunnyNet\Enum\Generator::BASE->value => [
            '/abusecase' => [
                'get' => ListAbuseCases::class,
            ],
            '/dmca/{id}' => [
                'get' => GetDmcaCase::class,
            ],
            '/abusecase/{id}' => [
                'get' => GetAbuseCase::class,
            ],
            '/dmca/{id}/resolve' => [
                'post' => ResolveDmcaCase::class,
            ],
            '/abusecase/{id}/resolve' => [
                'post' => ResolveAbuseCase::class,
            ],
            '/abusecase/{id}/check' => [
                'post' => CheckAbuseCase::class,
            ],
            '/auth/jwt/2fa' => [
                'post' => AuthJwt2fa::class,
            ],
            '/auth/jwt/refresh' => [
                'post' => RefreshJwt::class,
            ],
            '/billing' => [
                'get' => GetBillingDetails::class,
            ],
            '/billing/payment/autorecharge' => [
                'post' => ConfigureAutoRecharge::class,
            ],
            '/billing/payment/checkout' => [
                'post' => CreatePaymentCheckout::class,
            ],
            '/billing/payment/prepare-authorization' => [
                'get' => PreparePaymentAuthorization::class,
            ],
            '/billing/affiliate' => [
                'get' => GetAffiliateDetails::class,
            ],
            '/billing/affiliate/claim' => [
                'post' => ClaimAffiliateCredits::class,
            ],
            '/billing/coinify/exchangerate' => [
                'get' => GetCoinifyBitcoinExchangeRate::class,
            ],
            '/billing/coinify/create' => [
                'get' => CreateCoinifyPayment::class,
            ],
            '/billing/summary' => [
                'get' => GetBillingSummary::class,
            ],
            '/billing/summary/{billingRecordId}/pdf' => [
                'get' => GetBillingSummaryPDF::class,
            ],
            '/billing/applycode' => [
                'get' => ApplyPromoCode::class,
            ],
            '/dnszone/{id}/recheckdns' => [
                'post' => RecheckDnsConfiguration::class,
            ],
            '/dnszone/{id}/dismissnameservercheck' => [
                'post' => DismissDnsConfigurationNotice::class,
            ],
            '/drmcertificate' => [
                'get' => ListDrmCertificates::class,
            ],
            '/purge' => [
                'get' => PurgeUrlByHeader::class,
            ],
            '/search' => [
                'get' => GlobalSearch::class,
            ],
            '/support/ticket/list' => [
                'get' => ListTickets::class,
            ],
            '/support/ticket/details/{id}' => [
                'get' => GetTicketDetails::class,
            ],
            '/support/ticket/{id}/close' => [
                'post' => CloseTicket::class,
            ],
            '/support/ticket/{id}/reply' => [
                'post' => ReplyTicket::class,
            ],
            '/support/ticket/create' => [
                'post' => CreateTicket::class,
            ],
            '/storagezone/{id}/connections' => [
                'get' => GetStorageZoneConnections::class,
            ],
            '/user/homefeed' => [
                'get' => GetHomeFeed::class,
            ],
            '/user/notifications' => [
                'get' => ListNotifications::class,
            ],
            '/user' => [
                'get' => GetUserDetails::class,
                'post' => UpdateUserDetails::class,
            ],
            '/user/resend-email-confirmation' => [
                'post' => ResendEmailConfirmation::class,
            ],
            '/user/resetApiKey' => [
                'post' => ResetApiKey::class,
            ],
            '/user/closeaccount/reasons-list' => [
                'get' => ListCloseAccountReasons::class,
            ],
            '/user/closeaccount' => [
                'post' => CloseAccount::class,
            ],
            '/user/dpa' => [
                'get' => GetDpaDetails::class,
            ],
            '/user/dpa/accept' => [
                'post' => AcceptDpa::class,
            ],
            '/user/dpa/pdfhtml' => [
                'get' => GetDpaDetailsHtml::class,
            ],
            '/user/setNotificationsOpened' => [
                'post' => SetNotificationsOpened::class,
            ],
            '/user/whatsnew' => [
                'get' => GetWhatsNewItems::class,
            ],
            '/user/whatsnew/reset' => [
                'post' => ResetWhatsNew::class,
            ],
            '/user/2fa/generate-verification' => [
                'get' => GenerateTwoFactorAuthenticationVerification::class,
            ],
            '/user/2fa/disable' => [
                'post' => DisableTwoFactorAuthentication::class,
            ],
            '/user/2fa/enable' => [
                'post' => EnableTwoFactorAuthentication::class,
            ],
            '/user/2fa/verify' => [
                'post' => VerifyTwoFactorAuthenticationCode::class,
            ],
        ],
        default => [],
    };

    $data[$key] = [
        'apiSpecPath' => $file['fileUrl'],
        'modelDirectory' => $modelInputDirectory . '/' . $key,
        'mappingClassName' => $key,
        'outputDirectory' => $outputDirectory,
        'ignoreEndpoints' => $ignoreEndpoints,
        'keepUndocumentedEndpoints' => $keepUndocumentedEndpoints,
    ];
}

foreach ($data as $namespace => $config) {
    $generator = new MapGenerator(
        $config['apiSpecPath'],
        $config['outputDirectory'],
        $config['mappingClassName'],
        $config['modelDirectory'],
        $config['ignoreEndpoints'],
        $config['keepUndocumentedEndpoints'],
    );
    $generator->generate();

    echo "[$namespace] Mapping class generated successfully" . PHP_EOL;
}

// Autofix with php-cs-fixer
shell_exec('php vendor/bin/php-cs-fixer --quiet fix ' . realpath($outputDirectory));
