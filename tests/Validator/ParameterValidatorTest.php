<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Tests\Validator;

use PHPUnit\Framework\TestCase;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Exception\InvalidTypeForKeyValueException;
use ToshY\BunnyNet\Exception\InvalidTypeForListValueException;
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
