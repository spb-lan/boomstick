<?php

namespace Lan\Ebs\Boomstick\Interfaces;

interface Area
{
    //фабричный метод для создания
    public static function create(string $name): Area;

    // return all JSON structure of objects and collections
    public function renderJson(): string|false;

    //add Item
    public function addItem(Item $object): Area;

    public function addButton(string $buttonName, string $buttonValue, \Closure $callBack): Area;

    public function addSelect(string $selectName, string $selectValue, string $selectLabel, array $selectOptions, \Closure $callBack): Area;

    public function addInput(string $inputName, string $inputValue, string $inputLabel, \Closure $callBack): Area;
}

