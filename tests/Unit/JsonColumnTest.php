<?php

namespace Ebs\Tests;

use Lan\Ebs\Boomstick\Items\Common\Column;
use Tests\Support\UnitTester;

class JsonColumnTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    protected function _before()
    {
    }

    public function testColumn()
    {
        //генирим кнопку с action GET
        $column = new \stdClass();
        $column->name = 'publishers';
        $column->caption = 'Издатели';
        $column->active = 1;
        $column->primary_key = 0;
        $column->width = null;

        //получили стринг json
        $ebsJsonFormString = json_encode($column, JSON_UNESCAPED_UNICODE);
        $this->assertJson($ebsJsonFormString);

        //пустой width
        $columnObject = Column::create('publishers', 'Издатели');
        $ebsJsonColumnString = json_encode($columnObject, JSON_UNESCAPED_UNICODE);
        $this->assertJsonStringEqualsJsonString($ebsJsonFormString, $ebsJsonColumnString);

        //колонка с primaryKey
        $column->primary_key = 1;
        $columnObjectPk = Column::createWithPk('publishers', 'Издатели');
        $ebsJsonColumnStringPk = json_encode($columnObjectPk, JSON_UNESCAPED_UNICODE);
        $ebsJsonFormStringPk =  json_encode($column, JSON_UNESCAPED_UNICODE);
        $this->assertJsonStringEqualsJsonString($ebsJsonFormStringPk, $ebsJsonColumnStringPk);
    }


}
