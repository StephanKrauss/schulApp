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
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

    <!-- Javascript -->
    <script type="text/javascript" src="jquery/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/htm\14 l5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respo\16 nd.min.js"></script>
    <![endif]-->

    <style>
        a {
            text-decoration: none;
            color: black;
        }

        .navigation{
            border: 1px solid #e6e6e6; padding: 3px;
            background-color: #b3e0ff;
            text-align: center;
        }
    </style>
</head>
<body>



<img src="icon_schule_mini.png">

<table  style="min-width: 400px;" cellpadding="5" id="navigation">
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

<?php
include_once('stundenplan.php');

$dateien = scandir('plaene/');

foreach($dateien as $datei){
    if( strstr($datei, 'tplan-') ){
        $lesenStundenplanObjekt = new lesenStundenplan();
        $tabellen = $lesenStundenplanObjekt->setDatei($datei)->auswertung()->ausgabeTabellen();
        echo $tabellen;
    }
}
?>

</body>
</html>
