<?php

namespace Lan\Ebs\Boomstick\Items\Common;

class Style
{
    public $width;
    public $active;
    public $primary_key;

    public const DEFAULT_ACTIVE = 1;
    public const DEFAULT_NOT_ACTIVE = 0;
    public const DEFAULT_WIDTH = null;
    public const DEFAULT_NOT_PRIMARY_KEY = 0;
    public const DEFAULT_PRIMARY_KEY = 1;

    private function __construct($active = self::DEFAULT_ACTIVE, $primaryKey = self::DEFAULT_NOT_PRIMARY_KEY, $width = self::DEFAULT_WIDTH)
    {
        $this->active = $active;
        $this->primary_key = $primaryKey;
        $this->width = $width;
    }

    public static function create($active = self::DEFAULT_ACTIVE, $primaryKey = self::DEFAULT_NOT_PRIMARY_KEY, $width = self::DEFAULT_WIDTH)
    {
        return new self($active, $primaryKey, $width);
    }

    public static function createPk($width = self::DEFAULT_WIDTH, $active = self::DEFAULT_ACTIVE, $pimaryKey = 1)
    {
        return new self($active, $pimaryKey, $width);
    }

    public static function createPkWidth($width)
    {
        return self::createPk($width);
    }

    public static function createWidth($width, $active = self::DEFAULT_ACTIVE, $pimaryKey = self::DEFAULT_NOT_PRIMARY_KEY)
    {
        return self::create($active, $pimaryKey, $width);
    }

    //пока не решил какие варианты лучше
    public static function createPkNotActive()
    {
        return new self(self::DEFAULT_NOT_ACTIVE, self::DEFAULT_PRIMARY_KEY, self::DEFAULT_WIDTH);
    }

}