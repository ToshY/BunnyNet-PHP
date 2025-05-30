<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Tests\Validator;

use PHPUnit\Framework\TestCase;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Exception\InvalidTypeForKeyValueException;
use ToshY\BunnyNet\Exception\InvalidTypeForListValueException;
use ToshY\BunnyNet\Exception\ParameterIsRequiredException;
use ToshY\BunnyNet\Exception\UnexpectedParameterForObjectException;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Validator\ParameterValidator;

class ParameterValidatorTest extends TestCase
{
    public function testSingleStringTypeParameter(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
        ];

        $values = [
            'Parameter1' => 'test1',
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testSingleIntegerTypeParameter(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::INT_TYPE),
        ];

        $values = [
            'Parameter1' => 1,
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testSingleNumericTypeParameter(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::NUMERIC_TYPE),
        ];

        $values = [
            'Parameter1' => 1.23,
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testSingleArrayTypeParameter(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::ARRAY_TYPE),
        ];

        $values = [
            'Parameter1' => [],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testSingleBooleanTypeParameter(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::BOOLEAN_TYPE),
        ];

        $values = [
            'Parameter1' => true,
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testSingleObjectTypeParameter(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'MyObject', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'Prop1', type: Type::STRING_TYPE),
            ]),
        ];

        $values = [
            'MyObject' => [
                'Prop1' => 'value',
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testNestedObjectParameter(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'Parent', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'Child', type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'Grandchild', type: Type::INT_TYPE),
                ]),
            ]),
        ];

        $values = [
            'Parent' => [
                'Child' => [
                    'Grandchild' => 123,
                ],
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testObjectWithOptionalPropertyNotProvided(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'MyObject', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'RequiredProp', type: Type::STRING_TYPE, required: true),
                new AbstractParameter(name: 'OptionalProp', type: Type::INT_TYPE, required: false),
            ]),
        ];

        $values = [
            'MyObject' => [
                'RequiredProp' => 'hello',
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testObjectWithRequiredPropertyMissingThrowsException(): void
    {
        $this->expectException(ParameterIsRequiredException::class);
        $this->expectExceptionMessage(
            sprintf(
                ParameterIsRequiredException::MESSAGE,
                'RequiredProp',
            ),
        );

        $template = [
            new AbstractParameter(name: 'MyObject', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'RequiredProp', type: Type::STRING_TYPE, required: true),
                new AbstractParameter(name: 'OptionalProp', type: Type::INT_TYPE, required: false),
            ]),
        ];

        $values = [
            'MyObject' => [
                'OptionalProp' => 123,
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testArrayOfObjectsParameterValid(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'Variables', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'Value', type: Type::STRING_TYPE),
                ]),
            ]),
        ];

        $values = [
            'Variables' => [ // Correct key
                [
                    'Name' => 'VAR1',
                    'Value' => 'value1',
                ],
                [
                    'Name' => 'VAR2',
                    'Value' => 'value2',
                ],
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testArrayOfObjectsParameterThrowsExceptionOnMismatchedKey(): void
    {
        $this->expectException(UnexpectedParameterForObjectException::class);
        $this->expectExceptionMessage('Unexpected parameter `EnvironmentalVariables provided for `root object`, expected one of: [Variables].');

        $template = [
            new AbstractParameter(name: 'Variables', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'Value', type: Type::STRING_TYPE),
                ]),
            ]),
        ];

        $values = [
            'EnvironmentalVariables' => [
                [
                    'Name' => 'VAR1',
                    'Value' => 'value1',
                ],
                [
                    'Name' => 'VAR2',
                    'Value' => 'value2',
                ],
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    // New test cases based on provided examples

    public function testArrayOfStringsParameter(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'AllowedReferrers', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
        ];

        $values = [
            'AllowedReferrers' => [
                'example.com',
                'another.org',
                'sub.domain.net',
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testArrayOfSimpleObjectsParameter(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'Attachments', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'Body', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'FileName', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'ContentType', type: Type::STRING_TYPE),
                ]),
            ]),
        ];

        $values = [
            'Attachments' => [
                [
                    'Body' => 'base64encodedbody1',
                    'FileName' => 'file1.txt',
                    'ContentType' => 'text/plain',
                ],
                [
                    'Body' => 'base64encodedbody2',
                    'FileName' => 'image.jpg',
                    'ContentType' => 'image/jpeg',
                ],
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testArrayOfObjectsWithNestedObjectProperties(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'OptimizerClasses', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'Properties', type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: null, type: Type::STRING_TYPE), // Represents a map of string properties
                    ]),
                ]),
            ]),
        ];

        $values = [
            'OptimizerClasses' => [
                [
                    'Name' => 'class1',
                    'Properties' => [
                        'width' => '100px',
                        'height' => 'auto',
                    ],
                ],
                [
                    'Name' => 'class2',
                    'Properties' => [
                        'font-size' => '16px',
                        'color' => '#FFFFFF',
                    ],
                ],
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testDirectlyNestedObjectParameterGoogleWidevineDrm(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'GoogleWidevineDrm', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'Enabled', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'SdOnlyForL3', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'WidevineMinClientSecurityLevel', type: Type::INT_TYPE),
            ]),
        ];

        $values = [
            'GoogleWidevineDrm' => [
                'Enabled' => true,
                'SdOnlyForL3' => false,
                'WidevineMinClientSecurityLevel' => 1,
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testDirectlyNestedObjectParameterAppleFairPlayDrm(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'AppleFairPlayDrm', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'Enabled', type: Type::BOOLEAN_TYPE),
            ]),
        ];

        $values = [
            'AppleFairPlayDrm' => [
                'Enabled' => true,
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    // Existing tests below this line (unchanged)

    public function testSingleStringTypeParameterThrowsExceptionOnInteger(): void
    {
        $this->expectException(InvalidTypeForKeyValueException::class);
        $this->expectExceptionMessage(
            sprintf(
                InvalidTypeForKeyValueException::MESSAGE,
                'Parameter1',
                'string',
                'integer',
                5,
            ),
        );

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
        ];

        $values = [
            'Parameter1' => 5,
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testSingleStringTypeParameterThrowsExceptionOnNumeric(): void
    {
        $this->expectException(InvalidTypeForKeyValueException::class);
        $this->expectExceptionMessage(
            sprintf(
                InvalidTypeForKeyValueException::MESSAGE,
                'Parameter1',
                'string',
                'double',
                1.23,
            ),
        );

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
        ];

        $values = [
            'Parameter1' => 1.23,
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testSingleStringTypeParameterThrowsExceptionOnBoolean(): void
    {
        $this->expectException(InvalidTypeForKeyValueException::class);
        $this->expectExceptionMessage(
            sprintf(
                InvalidTypeForKeyValueException::MESSAGE,
                'Parameter1',
                'string',
                'boolean',
                1,
            ),
        );

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
        ];

        $values = [
            'Parameter1' => true,
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testSingleStringTypeParameterThrowsExceptionOnArray(): void
    {
        $this->expectException(InvalidTypeForKeyValueException::class);
        $this->expectExceptionMessage(
            sprintf(
                InvalidTypeForKeyValueException::MESSAGE,
                'Parameter1',
                'string',
                'array',
                json_encode([]),
            ),
        );

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
        ];

        $values = [
            'Parameter1' => [],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }


    public function testNestedParameters(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter2', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter3', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: 'NestedParameter1', type: Type::INT_TYPE),
                new AbstractParameter(name: 'NestedParameter2', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                ]),
            ]),
        ];

        $values = [
            'Parameter1' => 'test1',
            'Parameter2' => 'test2',
            'Parameter3' => [
                'NestedParameter1' => 1,
                'NestedParameter2' => [
                    'test3',
                    'test4',
                ],
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    /**
     * @note Tests "ARRAY_TYPE" that are objects; objects can be distinguished from arrays by checking the direct child.
     * If the direct child has a valid name (not `null`), then the parent is an object
     * If the direct child has a `null` name, then the parent is an array.
     *
     * Example is `Triggers` with `Type` at `ListEdgeScripts`.
     */
    public function testNestedParametersObjectArrayOptionalParentRequiredChild(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter2', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter3', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: 'NestedParameter1', type: Type::INT_TYPE, required: true),
                new AbstractParameter(name: 'NestedParameter2', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                ]),
            ]),
        ];

        $values = [
            'Parameter1' => 'test1',
            'Parameter2' => 'test2',
            'Parameter3' => [
                [
                    'NestedParameter1' => 1,
                    'NestedParameter2' => [
                        'test3',
                        'test4',
                    ],
                ],
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testNestedParametersCommaSeparatedValuesOnParemter2Child(): void
    {
        $this->expectNotToPerformAssertions();

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter2', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter3', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: 'NestedParameter1', type: Type::INT_TYPE),
                new AbstractParameter(name: 'NestedParameter2', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                ]),
            ]),
        ];

        $values = [
            'Parameter1' => 'test1',
            'Parameter2' => 'test2',
            'Parameter3' => [
                'NestedParameter1' => 1,
                'NestedParameter2' => [
                    'test3',
                    'test4,test5,test6,test7',
                ],
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testNestedParametersThrowsExceptionOnParameter1Type(): void
    {
        $this->expectException(InvalidTypeForKeyValueException::class);
        $this->expectExceptionMessage(
            sprintf(
                InvalidTypeForKeyValueException::MESSAGE,
                'Parameter1',
                'string',
                'integer',
                1,
            ),
        );

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter2', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter3', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: 'NestedParameter1', type: Type::INT_TYPE),
                new AbstractParameter(name: 'NestedParameter2', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                ]),
            ]),
        ];

        $values = [
            'Parameter1' => 1,
            'Parameter2' => 'test2',
            'Parameter3' => [
                'NestedParameter1' => 1,
                'NestedParameter2' => [
                    'test3',
                    'test4',
                ],
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testNestedParametersThrowsExceptionOnParameter3Type(): void
    {
        $this->expectException(InvalidTypeForKeyValueException::class);
        $this->expectExceptionMessage(
            sprintf(
                InvalidTypeForKeyValueException::MESSAGE,
                'Parameter3',
                'array',
                'integer',
                1,
            ),
        );

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter2', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter3', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: 'NestedParameter1', type: Type::INT_TYPE),
                new AbstractParameter(name: 'NestedParameter2', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                ]),
            ]),
        ];

        $values = [
            'Parameter1' => 'test1',
            'Parameter2' => 'test2',
            'Parameter3' => 1,
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testNestedParametersThrowsExceptionOnParameter3NestedParameter1ChildType(): void
    {
        $this->expectException(InvalidTypeForKeyValueException::class);
        $this->expectExceptionMessage(
            sprintf(
                InvalidTypeForKeyValueException::MESSAGE,
                'NestedParameter1',
                'int',
                'string',
                'test5',
            ),
        );

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter2', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter3', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: 'NestedParameter1', type: Type::INT_TYPE),
                new AbstractParameter(name: 'NestedParameter2', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                ]),
            ]),
        ];

        $values = [
            'Parameter1' => 'test1',
            'Parameter2' => 'test2',
            'Parameter3' => [
                'NestedParameter1' => 'test5',
                'NestedParameter2' => [
                    'test3',
                    'test4',
                ],
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }

    public function testNestedParametersThrowsExceptionOnParameter3NestedParameter2ChildType(): void
    {
        $this->expectException(InvalidTypeForListValueException::class);
        $this->expectExceptionMessage(
            sprintf(
                InvalidTypeForListValueException::MESSAGE,
                'NestedParameter2',
                'string',
                'integer',
                2,
            ),
        );

        $template = [
            new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter2', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Parameter3', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: 'NestedParameter1', type: Type::INT_TYPE),
                new AbstractParameter(name: 'NestedParameter2', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                ]),
            ]),
        ];

        $values = [
            'Parameter1' => 'test1',
            'Parameter2' => 'test2',
            'Parameter3' => [
                'NestedParameter1' => 1,
                'NestedParameter2' => [
                    2,
                    'test4',
                ],
            ],
        ];

        ParameterValidator::validate(
            $values,
            $template,
        );
    }
}
