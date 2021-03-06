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
            'termine' => 'active'
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
        <div class="col-md-11 col-md-offset-1 col-sm-11  col-sm-offset-1 col-xs-12">
            <table class="table table-striped table-bordered">
                <tbody>
                <tr>
                    <td>01.08. &ndash; 05.08.2016</td>
                    <td>Vorbereitungswoche</td>
                </tr>
                <tr>
                    <td>08.08.2016</td>
                    <td>Einführungstag / Methodentag alle Klassen</td>
                </tr>
                <tr>
                    <td>09.08.2016</td>
                    <td>Einführungstag / Methodentag 5. Klasse<br>
                        Beginn des Regelunterrichtes in den Klassen 6 &ndash; 10</td>
                </tr>
                <tr>
                    <td>10.08.2016</td>
                    <td>07:35 Uhr: 1. Zusammenkunft des Schülerrates</td>
                </tr>
                <tr>
                    <td>16.08.2016</td>
                    <td>1. Elternabend Klassenstufen 5 &ndash; 7, Wahl oder Bestätigung des Elternsprechers,<br>
                        Beginn 19.00 Uhr; außer Klasse 6a und 6b</td>
                </tr>
                <tr>
                    <td>17.08.2016</td>
                    <td>1. Elternabend Klassenstufe 8 &ndash; 10, Wahl oder Bestätigung des Elternsprechers,<br>
                        Beginn 19.00 Uhr</td>
                </tr>
                <tr>
                    <td>17.08.2016</td>
                    <td>07:35 Uhr: 2. Zusammenkunft des Schülerrates: Wahl des Schülerrates<br>
                        und der Schulkonferenzmitglieder</td>
                </tr>
                <tr>
                    <td>22.08.2016</td>
                    <td>1. Elternabend Klasse 6a und 6b, Wahl oder Bestätigung des Elternsprechers, Beginn 19.00 Uhr<br>
                        1. Elternratssitzung, Beginn 19.00 Uhr Zimmer 110</td>
                </tr>
                <tr>
                    <td>23.08. &ndash; 26.08.2016</td>
                    <td>Beachvolleyball auf dem Markt &ndash; Sonderplan durch Herrn Tröger<br>
                        + 23.08.2016&nbsp;&nbsp; &nbsp;10.00 &ndash; 11.00 Uhr &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;Klassenstufe 10&nbsp;&nbsp; &nbsp;(1. / 2.h Unterricht)<br>
                        + 24.08.2016&nbsp;&nbsp; &nbsp;ab 12.00 Uhr&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;Wettkampf ausgewählte Schüler<br>
                        + 25.08.2016&nbsp;&nbsp; &nbsp;8.00 &ndash; 9.00 Uhr&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;Klassenstufe 9&nbsp;&nbsp; &nbsp;ab 4. Stunde Unterricht<br>
                        + 26.08.2017&nbsp;&nbsp; &nbsp;Finale</td>
                </tr>
                <tr>
                    <td>08.09.2016</td>
                    <td>Öffentlichkeitsarbeit 18:15 Uhr; Lehrerzimmer</td>
                </tr>
                <tr>
                    <td>10.09.2016</td>
                    <td>Drachenbootrennen &ndash; Beginn 09:00 Uhr</td>
                </tr>
                <tr>
                    <td>19.09.2016 &ndash;<br>
                        23.09.2016</td>
                    <td>Klassenfahrt der Klassenstufe 10 nach Porec, Kroatien; Kolln. Eigler, Kolln. Hofmann</td>
                </tr>
                <tr>
                    <td>23.09.2016</td>
                    <td>Arbeitseinsatz des Elternrates auf dem kleinen Turnplatz</td>
                </tr>
                <tr>
                    <td>26.09.2016 &ndash;<br>
                        30.9.2016</td>
                    <td>Werkstatttage Klassenstufe 8</td>
                </tr>
                <tr>
                    <td>28.09.2016</td>
                    <td>1. Schulkonferenz, 19:00 Uhr Zimmer 110</td>
                </tr>
                <tr>
                    <td>29.09.2016</td>
                    <td>1. Großes Arbeitsgruppentreffen, 18:30 Uhr Lehrerzimmer</td>
                </tr>
                <tr>
                    <td>30.09.2016</td>
                    <td>Schulsporttag Sportabzeichen</td>
                </tr>
                <tr>
                    <td>03.10. 2016 &ndash;<br>
                        14.10.2016</td>
                    <td>Herbstferien</td>
                </tr>
                <tr>
                    <td>17.10.2016</td>
                    <td>Unterrichtsbeginn nach den Herbstferien</td>
                </tr>
                <tr>
                    <td>17.10.2016 &ndash;<br>
                        21.10.2016</td>
                    <td>Werkstattage Klassenstufe 9</td>
                </tr>
                <tr>
                    <td>31.10.2016</td>
                    <td>Reformationstag</td>
                </tr>
                <tr>
                    <td>10.11.2016</td>
                    <td>Klassenstufe 9 im Sächsischen Landtag, Kollegen Frau Kaufmann und Herr Tröger</td>
                </tr>
                <tr>
                    <td>16.11.2016</td>
                    <td>Buß &ndash; und Bettag</td>
                </tr>
                <tr>
                    <td>17.11.2016</td>
                    <td>Tag in der Oberschule, Hans &ndash; Marchwitza &ndash; Grundschule</td>
                </tr>
                <tr>
                    <td>18.11.2016</td>
                    <td>Tag in der Oberschule, Pestalozzi &ndash; Grundschule</td>
                </tr>
                <tr>
                    <td>23.11.2016</td>
                    <td>1. offener Elternabend (17.00 Uhr &ndash; 19.00 Uhr)<br>
                        Elternabend der beruflichen Schulzentren für die Klassenstufen 9 / 10; 19:00 Uhr</td>
                </tr>
                <tr>
                    <td>04.12.2016</td>
                    <td>Lichtelfest; 14:00 &ndash; 17:00 Uhr Schülercafè im Anbau in Verantwortung des Elternrates</td>
                </tr>
                <tr>
                    <td>22.12.2016</td>
                    <td>1. variabler unterrichtsfreier Tag</td>
                </tr>
                <tr>
                    <td>23.12. 2016 &ndash;<br>
                        02.01.2017</td>
                    <td>Weihnachtsferien</td>
                </tr>
                <tr>
                    <td>03.01.2017</td>
                    <td>Unterrichtsbeginn nach den Weihnachtsferien</td>
                </tr>
                <tr>
                    <td>06.01.2017</td>
                    <td>Vorprüfung Mathematik</td>
                </tr>
                <tr>
                    <td>12.01.2017</td>
                    <td>2. großes Arbeitsgruppentreffen; 18:30 Uhr im Lehrerzimmer</td>
                </tr>
                <tr>
                    <td>21.01.2017</td>
                    <td>Tag der offenen Tür 10.00 Uhr bis 13.00 Uhr</td>
                </tr>
                <tr>
                    <td>30.01.- 01.02.2017</td>
                    <td>Winterlager für die Klassenstufen 5 / 6</td>
                </tr>
                <tr>
                    <td>01.02.2017</td>
                    <td>2. Wandertag/Wintersporttag</td>
                </tr>
                <tr>
                    <td>06.02.2017</td>
                    <td>Elternabend Klassenstufe 6: Bildungsgang, 18:30 Uhr im Anbau</td>
                </tr>
                <tr>
                    <td>08.02.2017</td>
                    <td>Sportwettkampf mit den Schneeberger Grundschulen, 8.00 Uhr &ndash; 12.00 Uhr,<br>
                        Auswahlmannschaft der 5. Klassen</td>
                </tr>
                <tr>
                    <td>10.02.2017</td>
                    <td>+ Ausgabe der Halbjahresinformationen und Halbjahreszeugnisse<br>
                        + Ausgabe der Wahlbogen Fächerabwahl Klasse 9</td>
                </tr>
                <tr>
                    <td>13.02.- 24.02.2017</td>
                    <td>Winterferien</td>
                </tr>
                <tr>
                    <td>27.02.2017</td>
                    <td>Unterrichtsbeginn nach den Winterferien</td>
                </tr>
                <tr>
                    <td>27.02.2017 &ndash;<br>
                        10.03.2017</td>
                    <td>Betriebspraktikum Klassenstufe 9</td>
                </tr>
                <tr>
                    <td>28.02.2017</td>
                    <td>Mitteilung durch die Eltern der Klassenstufe 6 an die Schule: Bildungsgangentscheidung<br>
                        Mitteilung der Eltern Klassenstufe 5: Wechsel auf das Gymnasium</td>
                </tr>
                <tr>
                    <td>28.02.2017</td>
                    <td>2. offener Elternabend, 17:00 Uhr &ndash; 19:00 Uhr<br>
                        + Klassenstufe 5: &nbsp;&nbsp; &nbsp;Einführung in die Bildungsberatung, 19:00 Uhr<br>
                        + Klassenstufe 7: &nbsp;&nbsp; &nbsp;Berufsorientierung, 19:00 Uhr<br>
                        + Klassenstufe 8:&nbsp;&nbsp; &nbsp;Betriebspraktikum/ BLF in Klasse 9, 19:00 Uhr<br>
                        + Klassenstufe 9: &nbsp;&nbsp; &nbsp;EA zur BO durch Frau Thomas, 19:00 Uhr<br>
                        + Klassenstufe 10: &nbsp;&nbsp; &nbsp;Prüfungsbestimmungen, 19:00 UhrHinweis auf die Festlegungen zum Ausbildungsmarkt!!!!!</td>
                </tr>
                <tr>
                    <td>02.03.2017</td>
                    <td>+ Kompetenztest Deutsch Klasse 6<br>
                        + Kompetenztest Englisch Klasse 8<br>
                        + Abgabe der Wahlbogen zur Fächerabwahl</td>
                </tr>
                <tr>
                    <td>03.03.2017</td>
                    <td>Ausgabe der Bildungsempfehlungen und Empfehlungen zum Bildungsgang Klasse 6</td>
                </tr>
                <tr>
                    <td>03.03.- 10.03.2017</td>
                    <td>Anmeldung der künftigen Fünftklässler</td>
                </tr>
                <tr>
                    <td>13.03.-18.03.2017</td>
                    <td>Woche des offenen Unternehmens</td>
                </tr>
                <tr>
                    <td>22.03.2017</td>
                    <td>7. Schneeberger Ausbildungsmarkt, 15:00 Uhr &ndash; 18:00 Uhr, in der Turnhalle für alle Klassenstufen</td>
                </tr>
                <tr>
                    <td>10.04.2017 &ndash;<br>
                        12.04.2017</td>
                    <td>naturwissenschaftliche Tage mit Vorprüfung im naturwissenschaftlichen Fach</td>
                </tr>
                <tr>
                    <td>13.04.2017 &ndash;<br>
                        21.04.2017</td>
                    <td>Osterferien</td>
                </tr>
                <tr>
                    <td>24.04.2017 &ndash;<br>
                        28.04.2017</td>
                    <td>BSW &ndash; Woche Klassenstufe 7</td>
                </tr>
                <tr>
                    <td>28.04.2017</td>
                    <td>Jahresnoten in den 10. Klassen fertig / Ausgabe Wahlbogen mdl. Prüfung und naturwissenschaftliches. Fach</td>
                </tr>
                <tr>
                    <td>01.05.2017</td>
                    <td>Maifeiertag</td>
                </tr>
                <tr>
                    <td>02.05.2017</td>
                    <td>Übergabe der Jahresnoten an die Schüler der Klassenstufe 10</td>
                </tr>
                <tr>
                    <td>04.05.2017</td>
                    <td>Mitteilung der Schüler über das mündliche Prüfungsfach und das gewählte<br>
                        naturwissenschaftliche Fach</td>
                </tr>
                <tr>
                    <td>05.05.2017</td>
                    <td>schriftliche Englischprüfung, Prüfungskommissionssitzung</td>
                </tr>
                <tr>
                    <td>08.05.2017 &ndash;<br>
                        19.05.2017</td>
                    <td>Betriebspraktikum Klassenstufe 8</td>
                </tr>
                <tr>
                    <td>08.05.2017</td>
                    <td>schriftliche Deutschprüfung</td>
                </tr>
                <tr>
                    <td>10.05.2017</td>
                    <td>schriftliche Mathematikprüfung</td>
                </tr>
                <tr>
                    <td>12.05.2017</td>
                    <td>schriftliche Prüfung im naturwissenschaftlichen Fach</td>
                </tr>
                <tr>
                    <td>15.05.2017</td>
                    <td>Bekanntgabe der schriftlichen Englischprüfung</td>
                </tr>
                <tr>
                    <td>16.05.2017</td>
                    <td>Aufnahmebescheid der künftigen 5. Klassen</td>
                </tr>
                <tr>
                    <td>15.05.2017 &ndash;<br>
                        30.05.2017</td>
                    <td>Konsultationen</td>
                </tr>
                <tr>
                    <td>17.05.2017 &ndash;<br>
                        19.05.2017</td>
                    <td>praktischer Teil der Englischprüfung</td>
                </tr>
                <tr>
                    <td>22.05.2017</td>
                    <td>Bekanntgabe der schriftlichen Prüfungszensuren in D / En/ Ma / nat. Fach</td>
                </tr>
                <tr>
                    <td>23.05.2017</td>
                    <td>letzter Schultag Klasse 10; Leichtathletik &ndash; Sportfest Klassenstufe 5 &ndash; 9 im Stadion</td>
                </tr>
                <tr>
                    <td>24.5.2017</td>
                    <td>2. variabler unterrichtsfreier Tag</td>
                </tr>
                <tr>
                    <td>25.05.2017</td>
                    <td>Himmelfahrtstag</td>
                </tr>
                <tr>
                    <td>26.05.2017</td>
                    <td>unterrichtsfreier Tag</td>
                </tr>
                <tr>
                    <td>31.05.2017 &ndash;<br>
                        15.06.2017</td>
                    <td>mündliche Prüfungen</td>
                </tr>
                <tr>
                    <td>05.06.2017</td>
                    <td>Pfingstmontag</td>
                </tr>
                <tr>
                    <td>14.06.2017</td>
                    <td>2. Schulkonferenz</td>
                </tr>
                <tr>
                    <td>19.06.- 2017 &ndash;<br>
                        24.06.2017</td>
                    <td>Halli &ndash; Galli &ndash; Woche mit:<br>
                        + Sozialer Tag ????<br>
                        + Präsentation Talentfest ????<br>
                        + Schwimm- / Sporttag<br>
                        + 3. Wandertag<br>
                        + Vorbereitungen zum Schulfest 125 Jahre Schule???</td>
                </tr>
                <tr>
                    <td>20.06.2017</td>
                    <td>Ausgabe der Abschlusszeugnisse in der Goldnen Sonne, Beginn 18:00 Uhr</td>
                </tr>
                <tr>
                    <td>21.06.2017</td>
                    <td>Nullelternabend Klasse 5</td>
                </tr>
                <tr>
                    <td>24.06.2017</td>
                    <td>Ausgabe der Jahreszeugnisse</td>
                </tr>
                <tr>
                    <td>26.06.2017 &ndash;<br>
                        04.08.2017</td>
                    <td>Sommerferien</td>
                </tr>
                <tr>
                    <td>Wichtiger Hinweis:</td>
                    <td>Im Schuljahr 2017/2018 feiern wir 125 jähriges Schuljubiläum. Dieses wird in der Zeit vom 27.09.2017 &ndash; 29.09.2017 feierlich begangen.</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>