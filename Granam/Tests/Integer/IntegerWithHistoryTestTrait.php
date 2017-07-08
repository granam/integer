<?php
namespace Granam\Tests\Integer;

use Granam\History\Partials\WithHistory;
use Granam\Integer\IntegerObject;
use Granam\Integer\IntegerWithHistory;
use Granam\Tools\ValueDescriber;

/**
 * @method static assertInstanceOf($expected, $actual)
 * @method static assertEquals($expected, $actual)
 * @method static assertSame($expected, $actual)
 */
trait IntegerWithHistoryTestTrait
{
    /**
     * @test
     */
    public function I_can_use_it_as_object_with_history(): void
    {
        $integerWithHistory = new IntegerWithHistory(123);
        self::assertInstanceOf(IntegerObject::class, $integerWithHistory);
        self::assertInstanceOf(WithHistory::class, $integerWithHistory);
        $history = [
            [
                'changedBy' => [
                    'name' => 'i can use it as object with history',
                    'with' => '', // no parameters provided to this method
                ],
                'result' => $integerWithHistory,
            ],
        ];
        self::assertEquals($history, $integerWithHistory->getHistory());

        $added = $integerWithHistory->add(234);
        $history[] = [
            'changedBy' => [
                'name' => 'i can use it as object with history',
                'with' => '', // no parameters provided to this method
            ],
            'result' => $added,
        ];
        self::assertSame($history, $added->getHistory());

        $addedAgain = $this->addByDifferentMethod($added, 456);
        $history[] = [
            'changedBy' => [
                'name' => 'add by different method',
                'with' => implode(',', [ValueDescriber::describe($added), ValueDescriber::describe(456)]),
            ],
            'result' => $addedAgain,
        ];
        self::assertEquals($history, $addedAgain->getHistory());

        $subtracted = $addedAgain->sub(321);
        $history[] = [
            'changedBy' => [
                'name' => 'i can use it as object with history',
                'with' => '', // no parameters provided to this method
            ],
            'result' => $subtracted,
        ];
        self::assertSame($history, $subtracted->getHistory());

        $subtractedAgain = $this->subByDifferentMethod($subtracted, 1);
        $history[] = [
            'changedBy' => [
                'name' => 'sub by different method',
                'with' => implode(',', [ValueDescriber::describe($subtracted), ValueDescriber::describe(1)]),
            ],
            'result' => $subtractedAgain,
        ];
        self::assertEquals($history, $subtractedAgain->getHistory());

    }

    private function addByDifferentMethod(IntegerWithHistory $integerWithHistory, int $value): IntegerWithHistory
    {
        return $integerWithHistory->add($value);
    }

    private function subByDifferentMethod(IntegerWithHistory $integerWithHistory, int $value): IntegerWithHistory
    {
        return $integerWithHistory->sub($value);
    }
}