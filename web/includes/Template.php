<?php

class Template
{
    private static $engine = null;
    public static function init(Mustache_Engine $engine)
    {
        self::$engine = $engine;
    }

    public static function render($template, $data = [])
    {
        $template = self::$engine->loadTemplate($template);
        print $template->render($data);
    }
}
