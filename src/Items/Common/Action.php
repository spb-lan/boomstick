<?php
namespace Lan\Ebs\Boomstick\Items\Common;

class Action
{
    public function __construct(
        $method = 'GET',
        $route = '/',
        $routeName = self::EVENT_ON_CLICK,
        $event = self::EVENT_ON_CLICK,
        \Closure $callback = null)
    {
        $this->type = self::TYPE;
        $this->method = $method;
        $this->route = $route;
        $this->event = $event;
        $this->route_name = $routeName;
    }

    public const TYPE = 'action';
    public const EVENT_ON_CLICK = 'onclick';
    public const EVENT_ON_CHANGE = 'onchange';
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';

    public const EVENT_ON_MOUSE_OVER = 'onmouseover';
    public const EVENT_ON_MOUSE_OUT = 'onmouseout';
    public const EVENT_ON_KEY_DOWN = 'onkeydown';
    public const EVENT_ON_LOAD = 'onload';
    public const DEFAULT_ROUTE_NAME = 'default_button_value';


    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';

    /**
     * @return string|false
     */
    public function renderJson(): string|false
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }

    public static function createGet($route, $routeName = self::DEFAULT_ROUTE_NAME, $event = self::EVENT_ON_CLICK, \Closure $callback = null)
    {
        return new self(self::METHOD_GET, $route, $routeName, $event, $callback);
    }
    public static function createPost($route, $routeName = self::DEFAULT_ROUTE_NAME, $event = self::EVENT_ON_CLICK, \Closure $callback = null)
    {
        return new self(self::METHOD_POST, $route, $routeName, $event, $callback);
    }

    public static function createPut($route, $routeName = self::DEFAULT_ROUTE_NAME, $event = self::EVENT_ON_CLICK, \Closure $callback = null)
    {
        return new self(self::METHOD_PUT, $route, $routeName, $event, $callback);
    }

    public static function createDelete($route, $routeName = self::DEFAULT_ROUTE_NAME, $event = self::EVENT_ON_CLICK, \Closure $callback = null)
    {
        return new self(self::METHOD_DELETE, $route, $routeName, $event, $callback);
    }
}