<?php

namespace Lan\Ebs\Boomstick\Items\Common;

class Column implements \JsonSerializable
{
    public $name;
    public $caption;
    public $style;

    private function __construct(string $name = 'default_column', $caption = 'default_caption', Style $style = null, \Closure $callaback = null)
    {
        $this->name = $name;
        $this->caption = $caption;
        $this->style = $style;

        if (is_callable($callaback)) {
            $callaback($this);
        }
    }

    public static function create(string $name = 'default_column', string $caption = 'default_header', Style $style = null, \Closure $callback = null): self
    {
        return new self($name, $caption, $style, $callback);
    }

    public static function createWithPk(string $name, string $caption, ?\Closure $callback = null)
    {
        return Column::create($name, $caption, Style::createPk(), $callback);
    }

    public function jsonSerialize()
    {
        if (empty($this->style)) {
            $this->style = Style::create();
        }
        $column = new \stdClass();
        $column->name = $this->name;
        $column->caption = $this->caption;
        $column->active = $this->style->active;
        $column->primary_key = $this->style->primary_key;
        $column->width = $this->style->width;

        return $column;
    }
}