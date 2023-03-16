<?php

namespace Lan\Ebs\Boomstick\Items;

use Lan\Ebs\Boomstick\Interfaces\Item;
use Lan\Ebs\Boomstick\Items\Common\Action;

class Tabs implements Item
{
    public const TYPE = 'tab';
    public $actions = [];

    public function __construct(
        $anchor = 'default_name',
        $title = 'default_value',
        $description = 'default_label',
        \Closure $callback = null,
        $control = [])
    {
        $this->type = self::TYPE;
        $this->control = (object)$control;
        $this->control->title = $title;
        $this->control->anchor = $anchor;
        $this->control->description = $description;
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