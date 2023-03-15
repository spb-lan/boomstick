<?php

namespace JsonControlArea\Tests;

use Lan\Ebs\Boomstick\Items\Common\Action;
use Lan\Ebs\Boomstick\JsonControlArea;
use Tests\Support\UnitTester;

class JsonActionTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    protected function _before()
    {

    }

    private static function getActionExample()
    {
        return '{
        "type":"action",
        "method":"GET",
        "route":"ebs_get_stat_report",
        "event":{"subscriber_id":"int"},
        "route_name":"\/api\/v2\/reports\/stat\/{$subscriber_id}"
        }';
    }

    // check is Form generates right
    public function testRenderActionEmptyTest()
    {
        //генерим объект Action
        $action = new \stdClass();
        $action->type = 'action';
        $action->method = 'GET';
        $action->route = '/api/v2/reports/stat/${subscriber_id}';
        $action->event = 'onclick';
        $action->route_name = 'ebs_get_stat_report';
        //пилим по типу тайпскрипта

        //массив значений которые могут быть переданы через роут

        //получили стринг json
        $ebsJsonFormString = json_encode($action);
        //дампим его
        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $actualJsonAction = Action::createGet('/api/v2/reports/stat/${subscriber_id}', 'ebs_get_stat_report', Action::EVENT_ON_CLICK);
        $actualActionString = $actualJsonAction->renderJson();

        codecept_debug($actualActionString);

        $this->assertJsonStringEqualsJsonString($actualActionString, $ebsJsonFormString);
    }

    // check is Form generates right
    public function testRenderActionGetMethodTest()
    {
        //генерим объект Action
        $action = new \stdClass();
        $action->type = 'action';
        $action->method = 'GET';
        $action->route = '/api/v2/reports/stat/${subscriber_id}';
        $action->event = 'onclick';
        $action->route_name = 'ebs_get_stat_report';
        //пилим по типу тайпскрипта

        //массив значений которые могут быть переданы через роут

        //получили стринг json
        $ebsJsonFormString = json_encode($action);
        //дампим его
        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $actualJsonAction = Action::createGet('/api/v2/reports/stat/${subscriber_id}', 'ebs_get_stat_report');
        $actualActionString = $actualJsonAction->renderJson();

        codecept_debug($actualActionString);

        $this->assertJsonStringEqualsJsonString($actualActionString, $ebsJsonFormString);
    }

    // check is Form generates right
    public function testRenderActionPostMethodTest()
    {
        //генерим объект Action
        $action = new \stdClass();
        $action->type = 'action';
        $action->method = 'POST';
        $action->route = '/api/v2/reports/stat/${subscriber_id}';
        $action->event = 'onclick';
        $action->route_name = 'ebs_get_stat_report';
        //пилим по типу тайпскрипта

        //массив значений которые могут быть переданы через роут

        //получили стринг json
        $ebsJsonFormString = json_encode($action);
        //дампим его
        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $actualJsonAction = Action::createPost('/api/v2/reports/stat/${subscriber_id}', 'ebs_get_stat_report');
        $actualActionString = $actualJsonAction->renderJson();

        codecept_debug($actualActionString);

        $this->assertJsonStringEqualsJsonString($actualActionString, $ebsJsonFormString);
    }

    // check is Form generates right
    public function testRenderActionDeleteMethodTest()
    {
        //генерим объект Action
        $action = new \stdClass();
        $action->type = 'action';
        $action->method = 'DELETE';
        $action->route = '/api/v2/reports/stat/${subscriber_id}';
        $action->event = 'onclick';
        $action->route_name = 'ebs_get_stat_report';
        //пилим по типу тайпскрипта

        //массив значений которые могут быть переданы через роут

        //получили стринг json
        $ebsJsonFormString = json_encode($action);
        //дампим его
        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $actualJsonAction = Action::createDelete('/api/v2/reports/stat/${subscriber_id}', 'ebs_get_stat_report');
        $actualActionString = $actualJsonAction->renderJson();

        codecept_debug($actualActionString);

        $this->assertJsonStringEqualsJsonString($actualActionString, $ebsJsonFormString);
    }

    // check is Form generates right
    public function testRenderActionPutMethodTest()
    {
        //генерим объект Action
        $action = new \stdClass();
        $action->type = 'action';
        $action->method = 'PUT';
        $action->route = '/api/v2/reports/stat/${subscriber_id}';
        $action->event = 'onclick';
        $action->route_name = 'ebs_get_stat_report';
        //пилим по типу тайпскрипта

        //массив значений которые могут быть переданы через роут

        //получили стринг json
        $ebsJsonFormString = json_encode($action);
        //дампим его
        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $actualJsonAction = Action::createPut('/api/v2/reports/stat/${subscriber_id}', 'ebs_get_stat_report');
        $actualActionString = $actualJsonAction->renderJson();

        codecept_debug($actualActionString);

        $this->assertJsonStringEqualsJsonString($actualActionString, $ebsJsonFormString);
    }

}
