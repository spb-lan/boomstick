<?php

use Lan\Ebs\Boomstick\Items\Daterange;

class JsonDateRangeTest extends \Codeception\Test\Unit
{
    public function testEmptyDatepicker()
    {
        $expectedDatePickerObject = new \stdClass();
        $expectedDatePickerObject->type = 'daterange';
        $expectedDatePickerObject->actions =  [];
        $expectedDatePickerObject->control = new \stdClass();
        $expectedDatePickerObject->control->name = 'period';
        $exptdDatePickerString  = json_encode($expectedDatePickerObject,JSON_UNESCAPED_UNICODE);
        $this->assertJson($exptdDatePickerString);
        $actual =  DateRange::create('period');
        $actualDateRangeString = json_encode($actual,JSON_UNESCAPED_UNICODE);
        $this->assertJsonStringEqualsJsonString($exptdDatePickerString,$actualDateRangeString);
    }

    public function testEmptyDatepickerWithRange()
    {
        $expectedDatePickerObject = new \stdClass();
        $expectedDatePickerObject->type = 'daterange';
        $expectedDatePickerObject->actions =  [];
        $expectedDatePickerObject->control = new \stdClass();
        $expectedDatePickerObject->control->name = 'period';
        $expectedDatePickerObject->control->range  = new \stdClass();
        $expectedDatePickerObject->control->range->rangeFrom = '07-11-2021';
        $expectedDatePickerObject->control->range->rangeTo = '31-12-2023';
        $expectedDatePickerObject->control->range->format= 'y-m-D';

        $exptdDatePickerString  = json_encode($expectedDatePickerObject,JSON_UNESCAPED_UNICODE);
        $this->assertJson($exptdDatePickerString);

        $actual = DateRange::createWithRange('period','07-11-2021','31-12-2023','y-m-D');
        $actualDateRangeString = json_encode($actual,JSON_UNESCAPED_UNICODE);
        $this->assertJsonStringEqualsJsonString($exptdDatePickerString,$actualDateRangeString);
    }


}