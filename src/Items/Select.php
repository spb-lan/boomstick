<?php

namespace Lan\Ebs\Boomstick\Items;

use Lan\Ebs\Boomstick\Interfaces\Item;
use Lan\Ebs\Boomstick\Items\Common\Action;

class Select implements Item
{
    public $actions = [];
    public $control = [];

    const TYPE = 'select';

    public function __construct(
        $name = 'default_name',
        $value = 'default_value',
        $label = 'default_label',
        $selectOptions = [],
        \Closure $callback = null,
        $control = [])
    {
        $this->type = self::TYPE;
        $this->control = (object)$control;
        $this->control->name = $name;
        $this->control->value = $value;
        $this->control->label = $label;
        $this->control->options = $selectOptions;
    }

    /**
     * @return Item
     */
    public function addAction(Action $action): self
    {
        $this->actions[] = $action;
        return $this;
    }

    /**
     * @return string|false
     */
    public function renderJson(): string|false
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }
}