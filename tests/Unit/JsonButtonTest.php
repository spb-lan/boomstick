<?php

namespace Ebs\Tests;

use Lan\Ebs\Boomstick\Items\Button;
use Lan\Ebs\Boomstick\Items\Common\Action;
use Ice\Core\Route;
use Tests\Support\UnitTester;

class JsonButtonTest extends \Codeception\Test\Unit
{


    protected UnitTester $tester;

    protected function _before()
    {
    }

    public static function getButtonExample()
    {
        return '{
                    "type": "button",
                    "control": {
                        "name": "load_excel_report",
                        "value": "Загрузить Excel"
                    },
                    "actions": [
                    {
                       "method": "GET",
                       "route_name": "ebs_get_stat_report",
                       "route": "/api/v2/reports/stat/{$subscriber_id}",
                       "route_inputs": [{"subscriber_id": "int"}]
                       }
                    ]
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
    public function testRenderButtonEmptyJson()
    {
        //генирим кнопку с action GET
        $button = new \stdClass();
        $button->type = 'button';

        $control = new \stdClass();
        $control->name = 'load_excel_report';
        $control->value = 'Загрузить Excel';
        $button->control = $control;
        $button->actions = [];

        //получили стринг json
        $ebsJsonFormString = json_encode($button, JSON_UNESCAPED_UNICODE);
        //дампим его
        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $realJsonForm = Button::create('load_excel_report', 'Загрузить Excel');
        $realJsonForm->renderJson();
        $this->assertJsonStringEqualsJsonString($realJsonForm->renderJson(), $ebsJsonFormString);
    }


    /**
     * genereate Button with callback that changed params of button
     * @return void
     */
    public function testRenderButtonCallback()
    {
        //генирим кнопку с action GET
        $button = new \stdClass();
        $button->type = 'button';

        $control = new \stdClass();
        $control->name = 'load_excel_report_2';
        $control->value = 'Загрузить Excel_2';
        $button->control = $control;
        $button->actions = [];

        //получили стринг json
        $ebsJsonFormString = json_encode($button, JSON_UNESCAPED_UNICODE);
        //дампим его
        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $realJsonForm = Button::create('load_excel_report', 'Загрузить Excel', function ($button) {
            $button->control->name = 'load_excel_report_2';
            $button->control->value = 'Загрузить Excel_2';
        });
        codecept_debug($realJsonForm->renderJson());;

        $this->assertJsonStringEqualsJsonString($realJsonForm->renderJson(), $ebsJsonFormString);
    }

    /**
     * @return void
     */
    public function testRenderButtonWithAction()
    {
        //генерим объект Action
        $action = new \stdClass();
        $action->type = 'action';
        $action->method = 'GET';
        $action->route = '/api/v2/reports/stat/${subscriber_id}';
        $action->event = 'onclick';
        $action->route_name = 'ebs_get_stat_report';

        //генирим кнопку с action GET
        $button = new \stdClass();
        $button->type = 'button';

        $control = new \stdClass();
        $control->name = 'load_excel_report';
        $control->value = 'Загрузить Excel';
        $button->control = $control;
        $button->actions[] = $action;

        //получили стринг json
        $ebsJsonFormString = json_encode($button, JSON_UNESCAPED_UNICODE);

        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $realJsonForm = Button::create('load_excel_report', 'Загрузить Excel',
            function ($button) {
                /** @var Button $button */
                $button->addAction(Action::createGet('/api/v2/reports/stat/${subscriber_id}', 'ebs_get_stat_report', Action::EVENT_ON_CLICK));
            });

        $this->assertJsonStringEqualsJsonString($realJsonForm->renderJson(), $ebsJsonFormString);
    }

    public function testButtonSubmtitRender()
    {
        //генерим объект Action
        $action = new \stdClass();
        $action->type = 'action';
        $action->method = 'GET';
        $action->route = '/api/v2/reports/stat/${subscriber_id}';
        $action->event = 'onclick';
        $action->route_name = 'ebs_get_stat_report';

        //генирим кнопку с action GET
        $button = new \stdClass();
        $button->type = 'button';

        $control = new \stdClass();
        $control->type = 'submit';
        $control->name = 'load_excel_report';
        $control->value = 'Загрузить Excel';
        $button->control = $control;
        $button->actions[] = $action;

        //получили стринг json
        $ebsJsonFormString = json_encode($button, JSON_UNESCAPED_UNICODE);

        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $realJsonForm = Button::createSubmitButton('load_excel_report', 'Загрузить Excel',
            function ($button) {
                /** @var Button $button */
                $button->addAction(Action::createGet('/api/v2/reports/stat/${subscriber_id}', 'ebs_get_stat_report', Action::EVENT_ON_CLICK));
            });

        $this->assertJsonStringEqualsJsonString($realJsonForm->renderJson(), $ebsJsonFormString);
    }
}
