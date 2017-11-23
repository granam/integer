<?php
declare(strict_types=1); // on PHP 7+ are standard PHP methods strict to types of given parameters

namespace Granam\Integer;

use Granam\History\Partials\WithHistory;

class IntegerWithHistory extends IntegerObject implements WithHistory
{
    use IntegerWithHistoryTrait;
}