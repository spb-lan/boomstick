<?php

namespace Ebs\Tests;

use Lan\Ebs\Boomstick\Items\Common\Action;
use Lan\Ebs\Boomstick\Items\Common\Column;
use Lan\Ebs\Boomstick\Items\Tabs;
use Lan\Ebs\Boomstick\Table;
use Tests\Support\UnitTester;

class JsonTableTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    public static function getTabExample()
    {
        return '{
                    "type": "table",
                    "items": "books",
                    "actions": "[]",
                }';
    }

    // tests
    public function testSomeFeature()
    {
        $emptyJsonString = '{}';
        $this->assertJson($emptyJsonString);
    }

    /**
     * Generate empty Button
     * @return void
     */
    public function testRenderTabbleEmpty()
    {
        //генирим кнопку с action GET
        $table = new \stdClass();
        $table->type = 'table';
        $table->header = 'books';
        $table->actions = [];
        $table->rows = [];
        $table->columns = [];

        //получили стринг json
        $ebsJsonFormString = json_encode($table, JSON_UNESCAPED_UNICODE);
        $this->assertJson($ebsJsonFormString);
        //дампим его
        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $realJsonForm = new Table('books', []);

        codecept_debug($realJsonForm->renderJson());
        $this->assertJson($realJsonForm->renderJson());
        $this->assertJsonStringEqualsJsonString($realJsonForm->renderJson(), $ebsJsonFormString);
    }

    public function testRenderTabbleFilledSomeObjects()
    {
        $rows = [
            [
                'user__fk' => 111,
                'document_id' => 222,
                'document_type' => 33,
            ],
            [
                'user__fk' => 11,
                'document_id' => 22,
                'document_type' => 3,
            ]
        ];

        //генирим кнопку с action GET
        $table = new \stdClass();
        $table->type = 'table';
        $table->header = 'books';
        $table->actions = [];
        $table->columns = [];
        $table->rows = $rows;

        //получили стринг json
        $ebsJsonFormString = json_encode($table, JSON_UNESCAPED_UNICODE);
        $this->assertJson($ebsJsonFormString);
        //дампим его
        codecept_debug($ebsJsonFormString);

        //чекаем что оно json и прокидываем $rows
        $realJsonForm = new Table('books', $rows);

        codecept_debug($realJsonForm->renderJson());
        $this->assertJson($realJsonForm->renderJson());
        $this->assertJsonStringEqualsJsonString($realJsonForm->renderJson(), $ebsJsonFormString);
    }

    public function testGetTableWithColumn()
    {

        $rows = [
            [
                'user__fk' => 111,
                'document_id' => 222,
                'document_type' => 33,
            ],
            [
                'user__fk' => 11,
                'document_id' => 22,
                'document_type' => 3,
            ]
        ];

        //генирим кнопку с action GET
        $table = new \stdClass();
        $table->type = 'table';
        $table->header = 'books';
        $table->actions = [];
        $table->rows = $rows;

        $table->columns = [
            ['name' => 'id', 'caption' => 'ID', 'active' => 1, 'primary_key' => 1, 'width' => 100],
            ['name' => 'user__fk', 'caption' => 'Пользователь', 'active' => 1, 'primary_key' => 0, 'width' => 100],
            ['name' => 'document_id', 'caption' => 'ID Документа', 'active' => 1, 'primary_key' => 0, 'width' => 100],
            ['name' => 'document_type', 'caption' => 'Тип документа', 'active' => 1, 'primary_key' => 0, 'width' => 100],
        ];

        //получили стринг json
        $ebsJsonFormString = json_encode($table, JSON_UNESCAPED_UNICODE);
        $this->assertJson($ebsJsonFormString);

        //чекаем что оно json и прокидываем $rows
        $realJsonForm = Table::create('books', $rows)
            ->setColumnPk('id', 'ID',)
            ->setColumn('user__fk', 'Пользователь')
            ->setColumn('document_id', 'ID Документа')
            ->setColumn('document_type', 'Тип документа');

        $this->assertJson($realJsonForm->renderJson());
        $this->assertJsonStringEqualsJsonString($realJsonForm->renderJson(), $ebsJsonFormString);
    }

    public function testColumn()
    {
        //генирим кнопку с action GET
        $column = new \stdClass();
        $column->name = 'publishers';
        $column->caption = 'Издатели';
        $column->active = 1;
        $column->primary_key = 0;
        $column->width = 100;

        //получили стринг json
        $ebsJsonFormString = json_encode($column, JSON_UNESCAPED_UNICODE);
        $this->assertJson($ebsJsonFormString);

        $columnObject = Column::create('publishers', 'Издатели');
        $ebsJsonColumnString = json_encode($columnObject, JSON_UNESCAPED_UNICODE);

        $this->assertJsonStringEqualsJsonString($ebsJsonFormString, $ebsJsonColumnString);
    }


}
