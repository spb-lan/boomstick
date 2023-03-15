<?php

namespace Lan\Ebs\Boomstick\Items;

use Lan\Ebs\Boomstick\Interfaces\Item;

class Daterange implements Item
{

    public const DEFAULT_DATERANGE_TYPE = 'daterange';

    public $type = self::DEFAULT_DATERANGE_TYPE;
    public $actions = [];
    public $control = [];

    private function __construct(
        string   $name,
                 $control = [],
        \Closure $callback = null)
    {
        $this->type = self::DEFAULT_DATERANGE_TYPE;
        $this->control = (object)$control;
        $this->control->name = $name;

        if (is_callable($callback)) {
            $callback($this);
        }
    }

    public static function create(string $name, $control = [], \Closure $callback = null): self
    {
        return new self($name, $control, $callback);
    }

    public static function createWithRange(string $name, string $rangeFrom, string $rangeTo, string $format)
    {
        return self::create($name, ['range' => ['rangeFrom' => $rangeFrom, 'rangeTo' => $rangeTo, 'format' => $format]],);
    }


    public function renderJson(): string|false
    {
        // TODO: Implement renderJson() method.
    }

    public function addAction(\Lan\Ebs\Boomstick\Items\Common\Action $action): Item
    {
        $this->actions[] = $action;
        return $this;
    }
}