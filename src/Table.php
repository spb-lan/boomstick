<?php

namespace Lan\Ebs\Boomstick;

use Lan\Ebs\Boomstick\Interfaces\Item;
use Lan\Ebs\Boomstick\Items\Common\Action;
use Lan\Ebs\Boomstick\Items\Common\Column;
use Lan\Ebs\Boomstick\Items\Common\Style;

class Table implements Item
{
    public const TYPE = 'table';

    public $header = '';
    public $actions = [];
    public $columns = [];

    public static function create(string $tableName, array $rows = []): self
    {
        return new self($tableName, $rows);
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

    public function __construct(
        $tableName = 'default_header',
        $rows = [],
        $columns = [],
        \Closure $callback = null)
    {
        $this->type = self::TYPE;
        $this->header = $tableName;
        $this->rows = $rows;
        $this->columns = $columns;
    }

    public function setRows($rows): self
    {
        $this->rows = $rows;
        return $this;
    }

    public static function createTable($header, array $rows, \Closure $callback = null): self
    {
        return new self($header, $rows, $callback);
    }

    public function setColumn(string $name, string $caption, \Closure $callback = null): self
    {
        $this->columns[] = Column::create($name, $caption, Style::create(), $callback);

        return $this;
    }

    public function setColumnWidth(string $name, string $caption, $width, \Closure $callback = null): self
    {
        $this->columns[] = Column::create($name, $caption, Style::createWidth($width), $callback);
        return $this;
    }

    public function setColumnPk(string $name, string $caption, \Closure $callback = null): self
    {
        $this->columns[] = Column::create($name, $caption, Style::createPk(), $callback);
        return $this;
    }

    public function setColumnPkNotActive(string $name, string $caption, \Closure $callback = null): self
    {
        $this->columns[] = Column::create($name, $caption, Style::createPkNotActive(), $callback);
        return $this;
    }

    public function setColumnPkWidth(string $name, string $caption, \Closure $callback = null): self
    {
        $this->columns[] = Column::create($name, $caption, Style::createPkWidth(), $callback);
        return $this;
    }
}