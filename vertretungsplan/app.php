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

    <nav class="navbar navbar-default navbar-static-top hidden-lg hidden-md hidden-sm visible-xs" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    Oberschule Bergstadt Schneeberg
                </a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="../app.html">Kurznachrichten</a></li>
                    <li><a href="../stundenplan/app.php">Stundenpläne</a></li>
                    <li><a href="../aenderungsplan/app.php">Änderungspläne</a></li>
                    <li class="active"><a href="app.php">Vertretungspläne</a></li>
                    <li><a href="../kollegenplan/app.html">Kollegenplan</a></li>
                    <li><a href="../termine/app.html">Termine</a></li>
                    <li><a href="../speiseplan/app.html">Speiseplan</a></li>
                    <li><a href="../bilder/app.html">Bilder</a></li>
                    <li><a href="../kontakt/app.html">Kontakt</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-11 col-sm-11 col-xs-11 col-offset-md-1 col-sm-offset-1 col-xs-offset-1">
            <img src="../_public/image/icon_schule_mini.png">
        </div>
    </div>

    <div class="row">
        <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
            <?php
                error_reporting(4);
                include_once('../_src/templateEngine/Engine.php');

                include_once('../_src/standard.php');
                include_once('../_src/vertretungsplan.php');

            $dateienVerzeichnis = scandir('../_plaene/vertretungXml/');

            $i = 0;
            $dateien = [];

            foreach($dateienVerzeichnis as $zaehler => $dateiName){
                if(strstr($dateiName,'.xml')){
                    $dateien[$i] = $dateiName;
                    $i++;
                }
            }

            $content = '';
            $vertretungObj = new vertretungsplan();
            for($i = 0; $i < count($dateien); $i++){

                $tabelle = [];

                $vertretungObj
                    ->setDatei($dateien[$i])
                    ->steuerung();

                $tabelle['kopf'] = $vertretungObj->getKopf();
                $tabelle['stunden'] = $vertretungObj->getStunden();

                $engine = new \SimpleTemplate\Engine($tabelle);
                $engine->loadTemplate("view.html");
                $content .= $engine->getOutput();
            }

            echo $content;

            ?>
        </div>
    </div>
</div>

</body>
</html>
