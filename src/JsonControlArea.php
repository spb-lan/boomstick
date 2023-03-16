<?php

namespace Lan\Ebs\Boomstick;

use Lan\Ebs\Boomstick\Interfaces\Area;
use Lan\Ebs\Boomstick\Interfaces\Item;
use Lan\Ebs\Boomstick\Items\AreaItem;
use Lan\Ebs\Boomstick\Items\Button;

class JsonControlArea extends AreaItem implements Area
{
    public const TYPE = 'area';

    /** Пул items, кнопки, селекты и пречее
     * @var array
     */
    public array $items = [];

    /** Пул actions
     * @var array
     */
    public array $actions = [];

    public static function create($name = 'default'): self
    {
        return new self($name);
    }

    /**
     * @param $name
     */
    private function __construct($name)
    {
        $this->areaName = $name;
    }

    /**
     * @return string|false
     */
    public function renderJson(): string|false
    {
        $ebsJsonObject = new \stdClass();
        //добавить всё таки type
        $dataField = $this->getName();
        $ebsJsonObject->$dataField = $this->getItems();
        //кодируем все объекты и массивы в json
        return json_encode($ebsJsonObject, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return void
     */
    public function addAction(): self
    {
        return $this->addAction();
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param string $listBoxName
     * @param array $items
     * @return mixed
     */
    public function addCheckBox(string $checkboxName, string $checkBoxValue, \Closure $callBack): self
    {
        return $this->addItem(self::createCheckBox($checkboxName, $checkBoxValue, $callBack));
    }


    /**
     * @param string $buttonName
     * @param string $buttonValue
     * @param \Closure|null $buttonCallback
     * @return $this
     */
    public function addButton(string $buttonName, string $buttonValue, \Closure $buttonCallback = null): self
    {
        return $this->addItem(Button::createButton($buttonName, $buttonValue, $buttonCallback));
    }

    /**
     * @param string $submitName
     * @param string $buttonValue
     * @param \Closure|null $buttonCallback
     * @return $this
     */
    public function addButtonSubmit(string $submitName, string $buttonValue, ?\Closure $buttonCallback)
    {
        return $this->addItem(Button::createSubmitButton($submitName, $buttonValue, $buttonCallback));
    }

    /**
     * @param string $selectName
     * @param string $selectValue
     * @param string $selectLabel
     * @param array $selectOptions
     * @param \Closure|null $selectCallback
     * @return $this
     */
    public function addSelect(string   $selectName = 'default_select_control_name',
                              string   $selectValue = 'default_select_control_value',
                              string   $selectLabel = 'default_select_control_label',
                              array    $selectOptions = [],
                              \Closure $selectCallback = null): self
    {
        return $this->addItem(self::createSelect($selectName, $selectValue, $selectLabel, $selectOptions, $selectCallback));
    }

    public function addInput(string $inputName, string $inputValue, string $inputLabel, \Closure $callBack): Area
    {
        // TODO: Implement addInput() method.
    }

    public function addItem(Item $object): self
    {
        // TODO: Implement addItems() method.
        $this->items[] = $object;
        return $this;
    }

    public function getItems()
    {
        return $this->items;
    }


    public function setName(string $string): self
    {
        $this->areaName = $string;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->areaName;
    }
}