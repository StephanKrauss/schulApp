<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>Webapp der Oberschule Bergstadt Schneeberg</title>

    <!-- CSS -->
    <link href="/_public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/_public/bootstrap/css/theme.min.css" rel="stylesheet">
    <link href="/_public/css/main.css" rel="stylesheet">

    <!-- Javascript -->
    <script type="text/javascript" src="/_public/jquery/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="/_public/bootstrap/js/bootstrap.min.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/htm\14 l5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respo\16 nd.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="container">

    <?php
    include_once('../_src/templateEngine/Engine.php');

    $variables = array(
        'navigation' => array(
            'stundenplan' => 'active'
        )
    );

    $url = $_SERVER['SERVER_NAME'];
    $parsedUrl = parse_url($url);
    $host = explode('.', $parsedUrl['path']);

    if($host[0] == 'm'){
        $engine = new SimpleTemplate\Engine($variables);
        $engine->loadTemplate(false,"../navigation.html");
        echo $engine->getOutput();
    }

    if($host[0] == 'plus') {
        $engine = new SimpleTemplate\Engine($variables);
        $engine->loadTemplate(false,"../plus.html");
        echo $engine->getOutput();
    }
    ?>

    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-11 col-xs-offset-1 col-md-offset-1 col-sm-offset-1">
            <img src="../_public/image/icon_schule_mini.png">
        </div>
    </div>


    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1 col-sm-offset-1">
            <table id="navigation" class="col-md-8 col-sm-8 col-xs-12">
                <tr>
                    <td class="navigation"><a href="#5a"><div> 5a </div></a></td>
                    <td class="navigation"><a href="#5b"><div> 5b </div></a></td>
                    <td class="navigation"><a href="#6a"><div> 6a </div></a></td>
                    <td class="navigation"><a href="#6b"><div> 6b </div></a></td>
                </tr>
                <tr>
                    <td class="navigation"><a href="#6c"><div> 6c </div></a></td>
                    <td class="navigation"><a href="#7a"><div> 7a </div></a></td>
                    <td class="navigation"><a href="#7b"><div> 7b </div></a></td>
                    <td class="navigation"><a href="#8a"><div> 8a </div></a></td>
                </tr>
                <tr>
                    <td class="navigation"><a href="#9a"><div> 9a </div></a></td>
                    <td class="navigation"><a href="#9b"><div> 9b </div></a></td>
                    <td class="navigation"><a href="#10a"><div>10a</div></a></td>
                    <td class="navigation"><a href="#10b"><div>10b</div></a></td>
                </tr>
            </table>
        </div>

        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1 col-sm-offset-1">
            <?php
            include_once('../_src/standard.php');
            include_once('../_src/stundenplan.php');

            $subdomain = 'stundenplan';

            $dateien = scandir('../_plaene/stundenplanXml/');

            foreach($dateien as $datei){
                if( strstr($datei, 'tplan-') ){
                    $lesenStundenplanObjekt = new lesenStundenplan();

                    $tabellen = $lesenStundenplanObjekt
                        ->setSubdomain($subdomain)
                        ->setDatei($datei)
                        ->auswertung()
                        ->ausgabeTabellen();

                    echo $tabellen;
                }
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
