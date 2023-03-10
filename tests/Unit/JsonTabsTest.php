<?php

namespace Ebs\Tests;

use Lan\Ebs\Boomstick\Items\Common\Action;
use Lan\Ebs\Boomstick\Items\Tabs;
use Tests\Support\UnitTester;

class JsonTabsTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    public static function getTabExample()
    {
        return '{
                    "title": "Книги",
                    "name": "books",
                    "description": "Новые книги",
                    "route": "/subscriber/reports/new-resources/books"
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
    public function testRenderTabEmpty()
    {
        //генирим кнопку с action GET
        $tab = new \stdClass();
        $tab->type = 'tab';

        $control = new \stdClass();
        $control->title = 'Книги';
        $control->anchor = 'books';
        $control->description = 'Новые книги';
        $tab->control = $control;
        $tab->actions = [];

        //получили стринг json
        $ebsJsonFormString = json_encode($tab, JSON_UNESCAPED_UNICODE);
        //дампим его
        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $realJsonForm = new Tabs('books', 'Книги', 'Новые книги');

        $this->assertJsonStringEqualsJsonString($realJsonForm->renderJson(), $ebsJsonFormString);
    }

    /**
     * Generate empty Button
     * @return void
     */
    public function testRenderTabWithActionGet()
    {
        //генирим кнопку с action GET
        $tab = new \stdClass();
        $tab->type = 'tab';

        $control = new \stdClass();
        $control->title = 'Книги';
        $control->anchor = 'books';
        $control->description = 'Новые книги';
        $tab->control = $control;

        //генерим объект Action
        $action = new \stdClass();
        $action->type = 'action';
        $action->method = 'GET';
        $action->route = '/api/v2/reports/stat/${subscriber_id}';
        $action->event = 'onclick';
        $action->route_name = 'ebs_get_stat_report';

        $tab->actions[] = $action;

        //получили стринг json
        $ebsJsonFormString = json_encode($tab, JSON_UNESCAPED_UNICODE);
        //дампим его
        codecept_debug($ebsJsonFormString);

        //чекаем что оно json
        $realJsonForm = new Tabs('books', 'Книги', 'Новые книги');
        $realJsonForm->addAction(new Action('GET', '/api/v2/reports/stat/${subscriber_id}', 'ebs_get_stat_report', Action::EVENT_ON_CLICK));
        $this->assertJsonStringEqualsJsonString($realJsonForm->renderJson(), $ebsJsonFormString);
    }

}
