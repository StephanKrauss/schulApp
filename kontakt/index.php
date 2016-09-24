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
            'kontakt' => 'active'
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
        <div class="col-md-11 col-sm-11 col-xs-11 col-offset-md-1 col-sm-offset-1 col-xs-offset-1">
            <img src="../_public/image/icon_schule_mini.png">
        </div>
    </div>

    <div class="row">
        <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">

            <p>

                <h3>Schul App - Oberschule Bergstadt Schneeberg, Vers.: 0.8</h3>

                <h4>Kontaktdaten Oberschule</h4>

                Oberschule Bergstadt Schneeberg<br>
                Marienstr. 2a<br>
                08289 Schneeberg
            </p>

            <p>
                <a class="btn btn-success btn-lg glyphicon glyphicon-phone-alt visible-xs" role="button" href="tel:+0049377222520"> 03772 / 22520 </a><br>
                <span class="glyphicon glyphicon-phone-alt visible-sm"></span> Telefon: 03772 / 22520
            </p>

            <p>
                <a class="glyphicon glyphicon-envelope" href="mailto:os.bergstadt.schneeberg@t-online.de"> os.bergstadt.schneeberg@t-online.de </a>
            </p>
            <p>
                <a class="glyphicon glyphicon-send" href="http://www.oberschule-bergstadt-schneeberg.de.de" target="_blank"> www.oberschule-bergstadt-schneeberg.de.de </a>
            </p>

            <p>
            <h4>Entwickelt von Stephan Krauß</h4>
            </p>
            <p>
                <a class="glyphicon glyphicon-envelope" href="mailto:info@stephankrauss.de"> info@stephankrauss.de </a>
            </p>
            <p>
                <a class="glyphicon glyphicon-send" href="http://www.stephankrauss.de" target="_blank"> www.stephankrauss.de </a>
            </p>

        </div>
    </div>

</div>

</body>
</html>