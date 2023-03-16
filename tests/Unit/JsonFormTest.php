<?php

namespace JsonControlArea\Tests;

use Lan\Ebs\Boomstick\Items\Button;
use Lan\Ebs\Boomstick\Items\Common\Action;
use Lan\Ebs\Boomstick\JsonControlArea;
use Tests\Support\UnitTester;

class JsonFormTest extends \Codeception\Test\Unit
{
    //Вопросы
    //1.Нужны ли Вам id-шники?
    //2.

    protected UnitTester $tester;

    protected function _before()
    {

    }

    // tests

    public function testSomeFeature()
    {
        $emptyJsonString = '{}';
        $this->assertJson($emptyJsonString);
    }

    // check is Form generates right
    public function testRenderBottomJsonArea()
    {
        $ebsExcpectedJsonObject = new \stdClass();
        $ebsExcpectedJsonObject->bottom = [];

        //получили стринг json
        $ebsJsonFormString = json_encode($ebsExcpectedJsonObject);
        //дампим его
        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $actualJsonForm = JsonControlArea::create('bottom')
            ->renderJson();

        codecept_debug($actualJsonForm);

        $this->assertJsonStringEqualsJsonString($actualJsonForm, $ebsJsonFormString);
    }

    // check is Form generates right, with name
    public function testRenderEmptyFormWithName()
    {
        $ebsJsonObject = new \stdClass();
        $ebsJsonObject->right_area = [];

        //получили стринг json
        $ebsJsonFormString = json_encode($ebsJsonObject);
        //дампим его
        codecept_debug($ebsJsonFormString);
        //чекаем что оно json

        $realJsonForm = JsonControlArea::create()
            ->setName('right_area')
            ->renderJson();

        $this->assertJsonStringEqualsJsonString($realJsonForm, $ebsJsonFormString);
    }

    // Тест генерит Json форму с пустым селектом
    public function testRenderJsonFormWithEmptySelect()
    {
        $select = new \stdClass();
        $select->type = 'select';

        $control = new \stdClass();
        $control->name = 'select_of_subscribers';
        $control->value = 'Издательство Лань';
        $control->label = 'Подписчики';
        $control->options = [];

        $select->control = $control;
        $select->actions = [];

        $ebsFormExcpetedObject = new \stdClass();
        $ebsFormExcpetedObject->right_area[] = $select;

        //получили строчку json эталонного объекта
        $ebsJsonFormExpectedString = json_encode($ebsFormExcpetedObject, JSON_UNESCAPED_UNICODE);

        codecept_debug($ebsJsonFormExpectedString);

        $realJsonFormString = JsonControlArea::create('right_area')
            ->addSelect('select_of_subscribers', 'Издательство Лань', 'Подписчики')
            ->renderJson();

        $this->assertJson($realJsonFormString);

        $this->assertJsonStringEqualsJsonString($realJsonFormString, $ebsJsonFormExpectedString);
    }

    // Тест генерит Json форму с пустым селектом
    public function testRenderJsonFormWithEmptyButtonSelect()
    {
        $button = new \stdClass();
        $button->type = 'button';

        $control = new \stdClass();
        $control->name = 'button_download';
        $control->value = 'Пересчитать';

        $button->control = $control;
        $button->actions = [];

        $ebsFormExcpetedObject = new \stdClass();
        $ebsFormExcpetedObject->right_area[] = $button;

        //получили строчку json эталонного объекта
        $ebsJsonFormExpectedString = json_encode($ebsFormExcpetedObject, JSON_UNESCAPED_UNICODE);

        codecept_debug($ebsJsonFormExpectedString);

        $realJsonFormString = JsonControlArea::create('right_area')
            ->addButton('button_download', 'Пересчитать')
            ->renderJson();

        $this->assertJson($realJsonFormString);

        $this->assertJsonStringEqualsJsonString($realJsonFormString, $ebsJsonFormExpectedString);
    }

    // check is Form generates right
    public function testRenderJsonFormWithFilledListBox()
    {
        $select = new \stdClass();
        $select->type = 'select';

        $control = new \stdClass();
        $control->name = 'select_of_subscribers';
        $control->value = 'Издательство Лань';
        $control->label = 'Подписчики';
        $control->options = [
            [
                'subscriber_id' => 1000000,
                'subscriber_name' => 'Тестовый подписчик'
            ],
            [
                'subscriber_id' => 905,
                'subscriber_name' => 'Издательство Лань'
            ],
        ];

        $select->control = $control;
        $select->actions = [];

        $ebsFormExcpetedObject = new \stdClass();
        $ebsFormExcpetedObject->top_area[] = $select;

        //получили строчку json эталонного объекта
        $ebsJsonFormExpectedString = json_encode($ebsFormExcpetedObject, JSON_UNESCAPED_UNICODE);

        codecept_debug($ebsJsonFormExpectedString);

        $actualJsonFormString = JsonControlArea::create('top_area')
            ->addSelect('select_of_subscribers', 'Издательство Лань', 'Подписчики', [
                [
                    'subscriber_id' => 1000000,
                    'subscriber_name' => 'Тестовый подписчик'
                ],
                [
                    'subscriber_id' => 905,
                    'subscriber_name' => 'Издательство Лань'
                ],
            ])
            ->renderJson();

        $this->assertJson($actualJsonFormString);

        $this->assertJsonStringEqualsJsonString($actualJsonFormString, $ebsJsonFormExpectedString);
    }

    // генерируем форму с кнопкой
    public function testRenderJsonFormWithButtonGetAction()
    {
        //генерим объект Action
        $action = new \stdClass();
        $action->type = 'action';
        $action->method = 'GET';
        $action->route = '/api/v2/reports/stat/${subscriber_id}';
        $action->event = 'onclick';
        $action->route_name = 'ebs_get_stat_report';

        $button = new \stdClass();
        $button->type = 'button';

        $control = new \stdClass();
        $control->name = 'load_excel_report';
        $control->value = 'Загрузить Excel';
        $button->control = $control;
        $button->actions[] = $action;

        $ebsFormExcpetedObject = new \stdClass();
        $ebsFormExcpetedObject->left_area[] = $button;

        //получили строчку json эталонного объекта
        $ebsJsonFormExpectedString = json_encode($ebsFormExcpetedObject, JSON_UNESCAPED_UNICODE);

        codecept_debug($ebsJsonFormExpectedString);

        $this->assertJson($ebsJsonFormExpectedString);

        $actualFormWithButtonActionGetString = JsonControlArea::create('left_area')
            //добавляем кнопку, прокидываем коллбэк для action у кнопки
            ->addButton('load_excel_report', 'Загрузить Excel',
                function ($button) {
                    /** @var Button $button */
                    //TODO убрать new
                    $button->addAction(new Action('GET', '/api/v2/reports/stat/${subscriber_id}', 'ebs_get_stat_report'));
                })
            ->renderJson();

        codecept_debug($actualFormWithButtonActionGetString);

        $this->assertJsonStringEqualsJsonString($ebsJsonFormExpectedString, $actualFormWithButtonActionGetString);
    }


    public function testRenderJsonFormWithButtonGetQueryInputs()
    {
        //генерим объект Action
        $buttonAction = new \stdClass();
        $buttonAction->method = 'GET';
        $buttonAction->route_name = 'ebs_get_stat_report';
        $buttonAction->route = '/api/v2/reports/stat/{$subscriber_id}';

        $buttonAction->route_inputs = [
            'subscriber_id' => 'int',
        ];

        //инпуты на Action
        $buttonAction->query_inputs = [
            'from_date' => 'yyyy-mm-dd',
            'to_date' => 'yyyy-mm-dd',
            'subscriber_active' => 1
        ];
    }







//    // генерируем форму с кнопкой
//    public function testRenderJsonFormWithButtonGetDynamicRouteAction()
//    {
//        //генерим объект Action
//        $buttonAction = new \stdClass();
//        $buttonAction->method = 'GET';
//        $buttonAction->route_name = 'ebs_get_stat_report';
//        $buttonAction->route = '/api/v2/reports/stat/{$subscriber_id}';
//
//        $buttonAction->route_inputs = [
//            'subscriber_id' => 'int',
//        ];
//
//        //генирим кнопку с action GET
//        $formButton = new \stdClass();
//        $formButton->type = 'form_button';
//        $formButton->name = 'ebs_report_button_get_query';
//        $formButton->action = $buttonAction;
//
//
//        $ebsFormExpetedObject = new \stdClass();
//        $ebsFormExpetedObject->name = 'my_named_form_with_button_action_get';
//        $ebsFormExpetedObject->type = 'form';
//        $ebsFormExpetedObject->items[] = $formButton;
//
//        $ebsJsonFormExpectedString = json_encode($buttonAction, JSON_UNESCAPED_UNICODE);
//
//        codecept_debug($ebsJsonFormExpectedString);
//
//        $this->assertJson($ebsJsonFormExpectedString);
//
//
//
//        [
//            'api'=> 0,
//            'v2' => 1,
//            'reports' =>2,
//            'stat' =>
//        ];
////
////        class MyClass{
////            private $array = array('one', 'two', 'three');
////
////            function __call($func, $params){
////                if(in_array($func, $this->array)){
////                    return 'Test'.$func;
////                }
////            }
////        }
//
//
//        $actualFormWithButtonActionGetString = FormJson::queryBuilder()
//            ->setName('my_named_form_with_button_action_get')
//            ->addButton('ebs_report_button_get_query', function ($button) {
//                $button->addAction('GET', 'ebs_get_stat_report', '/api/v2/reports/stat/{$subscriber_id}')
//                    ->addRoute(

//IceRoute::getDynamicRouter()->ebs_get_route_stat_report(),
//IceRoute::ebs_get_route_stat_report()
//'/api/v2/reports/stat/{$subscriber_id}')
//    //TODO
//    //->addRoute()
//->addRouteInputs([
//'subscriber_id' => 'int',
//]);
//                        EbsRoute::create()
//                            ->api()
//                            ->reports()
//                            ->stat()
//                            ->subscriber_id('int')
//                            ->getRoute()
//                    )
//                    ->addRouteInputs([
//                        'subscriber_id' => 'int',
//                    ]);
//            })
//            ->rendorJson();
//
//
//        $this->assertJson($actualFormWithButtonActionGetString);
//
//        //Пробуем сгенирить форму Actual
//
//    }

}
