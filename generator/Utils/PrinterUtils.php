<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Utils;

use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PsrPrinter;

final class PrinterUtils
{
    public static function createFile(): PhpFile
    {
        $file = new PhpFile();
        $file->setStrictTypes();

        return $file;
    }

    public static function printFile(PhpFile $file): string
    {
        $printer = new PsrPrinter();

        return $printer->printFile($file);
    }

    public static function indentCode(string $code, int $spaces = 4): string
    {
        $indent = str_repeat(' ', $spaces);

        return implode("\n", array_map(fn ($line) => $indent . $line, explode("\n", $code)));
    }
}
