<?php

namespace Lan\Ebs\Boomstick\Interfaces;

use Lan\Ebs\Boomstick\Items\Common\Action;

interface Item
{
    // вернуть json строку объекта Button
    public function renderJson(): string|false;

    //добавить к элементу объект Action, для ajax
    public function addAction(Action $action): Item;

}

