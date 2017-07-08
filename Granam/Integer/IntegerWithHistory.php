<?php
namespace Granam\Integer;

use Granam\History\Partials\WithHistory;

class IntegerWithHistory extends IntegerObject implements WithHistory
{
    use IntegerWithHistoryTrait;
}