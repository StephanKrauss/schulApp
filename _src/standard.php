<?php

/**
 * Created by PhpStorm.
 * User: PC Stephan
 * Date: 18.08.2016
 * Time: 16:16
 */
class standard
{
    // Subdomain
    protected $subdomain = null;

    // übergebene XML - Datei
    protected $datei = null;

    // Inhalt der Stundenpläne / Raw
    protected $stundenplan = array();

    // HTML Tabellen
    protected $tabelle = '';

    // Farben der Stunden im Vertretungsplan
    protected $colorVertretungsplan = array(
        'karte' => '#cce6ff',
        'text' => '#000000',
        'aenderung' => '#ff66a3',
        'weiss' => '#ffffff'
    );

    protected $lehrer = array(
        'Peu' => 'Peuschel',
        'diSi'=> 'di Simoni',
        'Trö' => 'Tröger',
        'Ka' => 'Kallweit',
        'Kr' => 'Krauß',
        'Lor' => 'Lorenz',
        'Eig' => 'Eigler',
        'Ham' => 'Hammermeister',
        'Fin' => 'Findeißen',
        'Hof' => 'Hofmann',
        'Rü' => 'Rülke',
        'Kur' => 'Kurschat',
        'Kfm' => 'Kaufmann',
        'Schu' => 'Schulz',
        'Schr' => 'Schröter',
        'Hei' => 'Heider',
        'Dam' => 'Damm',
        'Schi' => 'Schiller',
        'Heß' => 'Heß',
        'Erl' => 'Erler',
        'Win' => 'Windisch',
        'Geor' => 'Georgi',
        'Bru' => 'Brutcher-Reinhardt',
        'Gra' => 'Gramsch',
        'Schm' => 'Schmiedel',
        'Hel' => 'Helm',
        'Sig' => 'Siegert',
        'Sta' => 'Stavenow',
        'Man' => 'Mann'
    );

    // Icon Information
    protected $infoIcon = '<img src="../_public/image/warning-3-24.png">';

    protected $tage = array(
        0 => ' Std. ',
        1 => ' Mo. ',
        2 => ' Die. ',
        3 => ' Mi. ',
        4 => ' Do. ',
        5 => ' Fr. '
    );

    protected $textFarbe = array('FR','FÖ','REe','WTH','DE','INT');

    protected $externeOrte = array(
        'TH1' => 'Turnhalle 1',
        'TH2' => 'Turnhalle 2',
        'SchwH' => 'Schwimmhalle'
    );

    protected $fachDetail = array(
        'MA' => array(
            'fach' => 'Ma',
            'farbe' => '#e6fffa'
        ),
        'SPO' => array(
            'fach' => 'Sp',
            'farbe' => '#4dd2ff'
        ),
        'DE' => array(
            'fach' => 'De',
            'farbe' => '#00ace6'
        ),
        'BIO' => array(
            'fach' => 'Bio',
            'farbe' => '#ffffcc'
        ),
        'EN' => array(
            'fach' => 'Eng',
            'farbe' => '#e6e600'
        ),
        'MU' => array(
            'fach' => 'Mu',
            'farbe' => '#00e673'
        ),
        'LEGO' => array(
            'fach' => 'LEGO',
            'farbe' => '#00cc66'
        ),
        'TC' => array(
            'fach' => 'TC',
            'farbe' => '#d9b38c'
        ),
        'GE' =>array(
            'fach' => 'Ge',
            'farbe' => '#e6ccb3'
        ),
        'ETH' => array(
            'fach' => 'Eth',
            'farbe' => '#ffd699'
        ),
        'REe' => array(
            'fach' => 'Rel ev.',
            'farbe' => '#e68a00'
        ),
        'PH' => array(
            'fach' => 'Phy',
            'farbe' => '#ff99ff'
        ),
        'FR' => array(
            'fach' => 'Fran',
            'farbe' => '#b300b3'
        ),
        'GEO' => array(
            'fach' => 'Geo',
            'farbe' => '#ffff00'
        ),
        'FÖ' => array(
            'fach' => 'F&ouml;',
            'farbe' => '#ac7339'
        ),
        'KU' => array(
            'fach' => 'Ku',
            'farbe' => '#ff1a8c'
        ),
        'CH' => array(
            'fach' => 'Ch',
            'farbe' => '#00b33c'
        ),
        'WTH' => array(
            'fach' => 'WTH',
            'farbe' => '#0040ff'
        ),
        'GK' => array(
            'fach' => 'Gesell',
            'farbe' => '#ccd9ff'
        ),
        'INF' => array(
            'fach' => 'Info',
            'farbe' => '#80ff80'
        ),
        'INT' => array(
            'fach' => 'Integ',
            'farbe' => '#3399ff'
        )
    );

    /**
     * Übergabe der XML - Datei
     *
     * @param $datei
     * @return $this
     */
    public function setDatei($datei){
        $this->datei = $datei;

        return $this;
    }

    public function setSubdomain($subdomain)
    {
        $this->subdomain = $subdomain;

        return $this;
    }
}