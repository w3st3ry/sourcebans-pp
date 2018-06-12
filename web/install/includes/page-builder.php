<?php

function route()
{
    $options = [
        'options' => [
            'min_range' => 1,
            'max_range' => 6,
            'default' => 1
        ]
    ];
    $step = filter_input(INPUT_GET, 'step', FILTER_VALIDATE_INT, $options);

    switch ($step) {
        case 6:
            return ['AMXBans Import', $step];
        case 5:
            return ['Initial Setup', $step];
        case 4:
            return ['Table Creation', $step];
        case 3:
            return ['System Requirements Check', $step];
        case 2:
            return ['Database Details', $step];
        default:
            return ['License Agreement', $step];
    }
}

function build($title, $step)
{
    Template::render('core/header', [
        'title' => $title,
        'steps' => getSteps($step)
    ]);
    Template::render('core/navbar');
    Template::render('core/content.header', ['title' => $title]);
    //require_once(ROOT."/pages/page.$step.php");
    Template::render('core/footer', [
        'version' => SB_VERSION,
        'quote' => CreateQuote()
    ]);
}
