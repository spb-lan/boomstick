<?php

namespace Lan\Ebs\Boomstick\Items;

use Lan\Ebs\Boomstick\Interfaces\Item;
use Lan\Ebs\Boomstick\Items\Common\Action;

class Checkbox implements Item
{
    public const TYPE = 'checkbox';

    public $actions = [];
    public $control = [];

    public function __construct(
        $name = 'default_name',
        $value = 'default_value',
        $label = 'default_label',
        \Closure $callback = null,
        $control = [])
    {
        $this->type = self::TYPE;
        $this->control = (object)$control;

        $this->control->name = $name;
        $this->control->value = $value;
        $this->control->label = $label;

        if (is_callable($callback)) {
            $callback($this);
        }
    }

    /**
     * @return string|false
     */
    public function renderJson(): string|false
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return Item
     */
    public function addAction(Action $action): self
    {
        $this->actions[] = $action;
        return $this;
    }
}