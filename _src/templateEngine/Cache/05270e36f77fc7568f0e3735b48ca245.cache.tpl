<?php
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
// Tabelle der Lehrer
$content['lehrer'] = $planKollegen->lehrerTabelle();
$enginePlan = new SimpleTemplate\Engine($content);
$enginePlan->loadTemplate('index.php');
echo $enginePlan->getOutput();