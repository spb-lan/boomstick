<?php

namespace Lan\Ebs\Boomstick\Interfaces;

interface Control
{
    //фабричный метод для создания
    public static function create(string $name): Item;

}

