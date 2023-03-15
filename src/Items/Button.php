<?php

namespace Lan\Ebs\Boomstick\Items;

use Lan\Ebs\Boomstick\Interfaces\Item;
use Lan\Ebs\Boomstick\Items\Common\Action;

class Button implements Item
{
    public const TYPE = 'button';

    public $actions = [];
    public $control = [];

    public function __construct(
        $name = 'default_name',
        $value = 'default_value',
        \Closure $callback = null,
        $control = [])
    {
        $this->type = self::TYPE;
        $this->control = (object)$control;
        $this->control->name = $name;
        $this->control->value = $value;

        if (is_callable($callback)) {
            $callback($this);
        }
    }

    /**
     * @param string $buttonName
     * @param string $buttonValue
     * @param \Closure|null $callBack
     * @return Button
     */
    public static function create(string $buttonName, string $buttonValue, \Closure $callBack = null): self
    {
        return new self($buttonName, $buttonValue, $callBack);
    }

    /**
     * @param $name
     * @param $value
     * @param \Closure|null $callback
     * @return Button
     */
    public static function createSubmitButton(string $submitButton, string $submitValue, \Closure $callback = null): Button
    {
        $self = new self($submitButton, $submitValue, $callback);
        $self->control->type = 'submit';
        return $self;
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