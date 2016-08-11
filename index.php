<html>
<head>
    <title>Stundenplände der Oberschule Bergstadt Schneeberg</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

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
