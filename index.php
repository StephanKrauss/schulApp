<?php
if($_POST){
    if( ($_POST['benutzer'] == 'lehrer') and ($_POST['kennung'] == 'kt3p4u') )
        header('Location: stundenplan/index.php');
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>Stundenplände der Oberschule Bergstadt Schneeberg</title>

    <!-- CSS -->
    <link href="stundenplan/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="stundenplan/css/main.css" rel="stylesheet">

    <!-- Javascript -->
    <script type="text/javascript" src="stundenplan/jquery/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="stundenplan/bootstrap/js/bootstrap.min.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/htm\14 l5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respo\16 nd.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">

        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-8 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                <img src="stundenplan/icon_schule_mini.png">
            </div>
        </div>
        <div class="row">
            <form class="form-horizontal" method="post" action="index.php">
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 col-xs-3 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 control-label" for="benutzer">Benutzer:</label>
                    <div class="col-md-4 col-sm-4 col-xs-7">
                        <input placeholder="Benutzerkennung" class="form-control" name="benutzer" id="benutzer" type="text" required pattern="[A-Za-z0-9]{3,10}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-3 col-xs-3 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 control-label" for="kennung">Passwort:</label>
                    <div class="col-md-4 col-sm-4 col-xs-7">
                        <input placeholder="Passwort" class="form-control" type="password" name="kennung" id="kennung" required pattern="[A-Za-z0-9]{3,10}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-sm-4 col-xs-8 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                        <button class="btn btn-success" name="senden">anmelden</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>