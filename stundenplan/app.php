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
                    <li class="active"><a href="app.php">Stundenpläne</a></li>
                    <li><a href="../aenderungsplan/app.php">Änderungspläne</a></li>
                    <li><a href="../vertretungsplan/app.php">Vertretungspläne</a></li>
                    <li><a href="../kollegenplan/app.html">Kollegenplan</a></li>
                    <li><a href="../termine/app.html">Termine</a></li>
                    <li><a href="../speiseplan/app.html">Speiseplan</a></li>
                    <li><a href="../bilder/app.html">Bilder</a></li>
                    <li><a href="app.html">Kontakt</a></li>
                </ul>
            </div>
        </div>
    </nav>

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
