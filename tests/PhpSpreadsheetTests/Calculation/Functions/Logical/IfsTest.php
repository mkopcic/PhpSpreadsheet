<?php

declare(strict_types=1);

namespace PhpOffice\PhpSpreadsheetTests\Calculation\Functions\Logical;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;

class IfsTest extends AllSetupTeardown
{
    #[\PHPUnit\Framework\Attributes\DataProvider('providerIFS')]
    public function testIFS(mixed $expectedResult, mixed ...$args): void
    {
        $this->runTestCase('IFS', $expectedResult, ...$args);
    }

    public static function providerIFS(): array
    {
        return require 'tests/data/Calculation/Logical/IFS.php';
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('providerIfsArray')]
    public function testIfsArray(array $expectedResult, string $bool1, string $argument1, string $bool2, string $argument2): void
    {
        $calculation = Calculation::getInstance();

        $formula = "=IFS($bool1, {" . "$argument1}, $bool2, {" . "$argument2})";
        $result = $calculation->_calculateFormulaValue($formula);
        self::assertEquals($expectedResult, $result);
    }

    public static function providerIfsArray(): array
    {
        return [
            'array return first item' => [
                [[1, 2, 3]],
                'true',
                '1, 2, 3',
                'true',
                '4, 5, 6',
            ],
            'array return second item' => [
                [[4, 5, 6]],
                'false',
                '1, 2, 3',
                'true',
                '4, 5, 6',
            ],
        ];
    }
}
