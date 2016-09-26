<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

    include_once('../_src/templateEngine/Engine.php');
    include_once('../_src/standard.php');
    include_once('kollegenplan.php');

    $variables = array(
        'navigation' => array(
            'kollegenplan' => 'active'
        )
    );

    $url = $_SERVER['SERVER_NAME'];
    $parsedUrl = parse_url($url);
    $host = explode('.', $parsedUrl['path']);

    $content = [];

    // Navigation
    if($host[0] == 'm'){
        $engine = new SimpleTemplate\Engine($variables);
        $engine->loadTemplate(false,"../navigation.html");
        $navigation = $engine->getOutput();
    }

    if($host[0] == 'plus') {
        $engine = new SimpleTemplate\Engine($variables);
        $engine->loadTemplate(false,"../plus.html");
        $navigation = $engine->getOutput();
    }

    $content['navigation'] = $navigation;

    $planKollegen = new kollegenplan();

    // Kollegenplan
    if(is_array($_GET) and array_key_exists('lehrer',$_GET))
        $content['plan'] = $planKollegen->ermittelnStundenLehrer($_GET['lehrer'])->getTabelle();
    // Auflistung der Lehrer
    else
        $content['lehrer'] = $planKollegen->lehrerTabelle();

    // Kollege
    $content['kollege'] = $planKollegen->getLehrer();

    $enginePlan = new SimpleTemplate\Engine($content);
    $enginePlan->loadTemplate('kollegenplan.html');
    echo $enginePlan->getOutput();

?>