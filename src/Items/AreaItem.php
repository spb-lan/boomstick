<?php

namespace Lan\Ebs\Boomstick\Items;

use Lan\Ebs\Boomstick\Interfaces\Area;

abstract class AreaItem implements Area
{
    const TYPE = 'area';

    private $type = self::TYPE;
    private $name = 'default_area';
    private $items = [];

    protected static function createSelect(string $selectName, string $selectValue, string $selectLabel, array $selectOptions, \Closure|null $selectCallback): Select
    {
        return new Select($selectName, $selectValue, $selectLabel, $selectOptions, $selectCallback);
    }

    protected static function createCheckBox(string $checkboxName, string $checkBoxValue, \Closure|null $callBack): Checkbox
    {
        return new Checkbox();
    }
}