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
    <link href="/_public/public/css/main.css" rel="stylesheet">

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
            'info' => 'active'
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
    ?>

    <div class="row">
        <div class="col-md-11 col-sm-11 col-xs-11 col-offset-md-1 col-sm-offset-1 col-xs-offset-1">
            <img src="/_public/image/icon_schule_mini.png">
        </div>
    </div>


    <div class="row">
        <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1 col-sm-offset-1 col-xs-offset-1" id="twitter-wjs">
            <h3>WebApp der Oberschule Bergstadt Schneeberg</h3>

            <p>
                Diese WebApp kommt auf Android-Handys zum Einsatz.<br>
                Darstellung der Stundenpläne und Vertretungspläne einer Schule auf dem Smartphone<br>
                und in der Homepage der Schule.
            </p>


            <h4>erledigt:</h4>

            <ul>
                <li><b>Version 0:</b></li>
                <li><a href="https://github.com/StephanKrauss/schulApp" target="_blank">anlegen Repository Github</a></li>

                <li><b>Version 0.1:</b></li>
                <li>Kurznachrichten der Schule</li>

                <li><b>Version 0.2:</b></li>
                <li>interaktiver Stundenplan der Schule</li>

                <li><b>Version 0.3:</b></li>
                <li>Vertretungspläne der Schule</li>

                <li><b>Version 0.4:</b></li>
                <li>Jahresterminplan der Schule</li>

                <li><b>Version 0.5:</b></li>
                <li>Kontaktseite mit Telefonanbindung</li>

                <li><b>Version 0.6:</b></li>
                <li><a href="https://play.google.com/store/search?q=Oberschule&hl=de" target='_blank'>WebApp der Schule im 'Google Play Store'</a></li>

                <li><b>Version 0.7:</b></li>
                <li>Änderungsplan der Schule mit Markierung der Veränderungen</li>
            </ul>


            <h4>in Arbeit:</h4>

            <ul>
                <li>Speiseplan</li>
                <li>Bildergalerie</li>
                <li>Kollegenplan</li>
            </ul>


            <h4>strategische Ausrichtung:</h4>
            <ul>
                <li>erstellen einer Template Engine speziell für WebApps</li>
                <li>umschreiben eines ORM für die Anbindung an relationale Datenbanken</li>
                <li>erstellen eines Verfahren für die Einbindung der WebApp in eine Homepage ( Wordpress )</li>
                <li>erstellen eines Plus - Angebotes für die Homepage</li>
                <li>erstellen einer WebApp für Android Smartphone</li>
            </ul>

        </div>
    </div>
</div>

</body>
</html>