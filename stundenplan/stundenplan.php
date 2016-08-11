<?php

class lesenStundenplan
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

    // Icon Information
    protected $infoIcon = '<img src="warning-3-24.png">';

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

    /**
     * Auswertung der XML - Datei
     *
     * @return $this
     */
    public function auswertung()
    {
        if($this->subdomain == null)
            exit();

        if($this->datei == null)
            exit();

        if( ($this->subdomain != 'stundenplan') and ($this->subdomain != 'vertretungsplan') )
            exit();

        // lesen XML - Datei
        $this->lesenXml();

        return $this;
    }

    /**
     * erstellen der Wochentage in der ersten Zeiule Tabelle
     */
    protected function erstellenWochentage()
    {
        foreach ($this->tage as $zahl => $tag) {
            $this->stundenplan[$zahl][0] = $tag;
        }

        return;
    }

    /**
     * lesen der XML Datei der Klassen
     *
     * @return SimpleXMLElement
     */
    protected function lesenXml()
    {
        $reader = new XMLReader;
        $reader->open('plaene/'.$this->datei);

        while($reader->read()){

            if($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'kopf'){
                $kopf = simplexml_load_string($reader->readOuterXml());

                $this->tabelle .= '<h2>g&uuml;ltig ab: '.$kopf->gueltigab.'</h2>';
            }


            if($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'kl'){

                // Speicher löschen
                $this->stundenplan = [];

                // erste Zeile mit den Wochentagen
                $this->erstellenWochentage();

                $stundenplan = simplexml_load_string($reader->readOuterXml());

                // Überschrift
                $this->tabelle .= '<h3 style="text-decoration: underline;" id="'.$stundenplan->kl_kurz.'">Klasse: '.$stundenplan->kl_kurz.'</h3>';

                // Zeiten der Klasse
                $this->ermittelnZeitenDerKlasse($stundenplan);

                // Stunden der Klasse
                $this->ermittelnStundenDerKlasse($stundenplan);

                // Tabelle zeichnen
                $this->tabelleErstellen($stundenplan->kl_kurz);
            }
        }
    }

    /**
     * erstellt den Inhalt der Tabellen
     */
    protected function tabelleErstellen()
    {
        $tabelle = '<table cellpadding="5" style="min-width: 400px;">';

        $zeile = 0;
        for($j=0; $j < 10; $j++) {
            $tabelle .= '<tr>';

            for ($tag = 0; $tag < 6; $tag++) {

                if( (array_key_exists($tag,$this->stundenplan)) and (array_key_exists($zeile, $this->stundenplan[$tag])) ){
                    $inhalt = $this->stundenplan[$tag][$zeile];

                    $tabelle .= '<td style="border: 1px solid #e6e6e6; padding: 3px;" valign="top">'.$inhalt.'</td>';
                }
                else{
                    $tabelle .= '<td style="border: 1px solid #e6e6e6;padding: 3px;" valign="top">&nbsp;</td>';
                }
            }
            $tabelle .= '</tr>';

            $zeile++;
        }

        $tabelle .= '</table><br>';
        $tabelle .= '<a href="#top" style="text-decoration: none; color: #000000;;" class="navigation"> >> nach oben << </a>';

        $this->tabelle .= $tabelle;

        return;
    }

    /**
     * Ausgabe der Stundenpläne
     *
     * @return string
     */
    public function ausgabeTabellen()
    {
        return $this->tabelle;

    }

    /**
     * ermitteln der Zeiten / Stunden der Klasse
     *
     * @param $stundenplan
     * @return int
     */
    protected function ermittelnZeitenDerKlasse($stundenplan)
    {
        $zeitenDerKlasse = $stundenplan->kl_stunde;

        for ($i = 0; $i < $zeitenDerKlasse->count(); $i++) {
            $attributes = (array)$stundenplan->kl_stunde[$i]->attributes();
            $zeit = $attributes['@attributes']['kl_zeit'];

            $schulstunde = $i + 1;

            $this->stundenplan[0][$i + 1] = $schulstunde.'.<br>'.$zeit;
        }
        return $i;
    }

    /**
     * ermitteln Fächer der Klassen
     *
     * @param $stundenplan
     */
    protected function ermittelnStundenDerKlasse($stundenplan)
    {
        for ($i = 0; $i < $stundenplan->kl_plan->pl->count(); $i++) {
            $stundenDerKlasse = $stundenplan->kl_plan->pl[$i];

            // $besonderheiten = $this->ermittelnBesonderheiten($stundenDerKlasse);
            $besonderheiten = ' ';

            $fach = $stundenplan->kl_plan->pl[$i]->pl_fach;
            $fachDetail = $this->umbenennenFach((string) $fach);

            $ort = $stundenplan->kl_plan->pl[$i]->pl_raum;
            // $ort = $this->aendernOrt($ort);

            // Stundenplan
            if($this->subdomain == 'stundenplan')
                $this->darstellungStundenplan($stundenDerKlasse, $fachDetail, $ort, $besonderheiten);
            // Vertretungsplan
            elseif($this->subdomain == 'vertretungsplan')
                $this->darstellungVertretungsplan($stundenDerKlasse, $fachDetail, $ort, $besonderheiten);
        }

        return;
    }

    /**
     * setzt ein Signal wenn eine Besonderheit vorliegt
     *
     * @param $stundenDerKlasse
     * @return string
     */
    protected function ermittelnBesonderheiten($stundenDerKlasse)
    {
        $besonderheiten = ' ';

        $fach = $stundenDerKlasse->pl_fach;
        $raum = $stundenDerKlasse->pl_raum;

        if($fach->attributes())
            $besonderheiten = $this->infoIcon;
        elseif ($raum->attributes())
            $besonderheiten = $this->infoIcon;

        return $besonderheiten;
    }

    /**
     * verbessert die Anzeige des Ortes
     *
     * @param $ort
     * @return mixed|string
     */
    protected function aendernOrt($ort)
    {
        $ort = (string) $ort;

        if(empty($ort)){
            $ort = 'unbekannt';
        }
        elseif(preg_match('#^([0-9]{3,3})#',$ort)){
            $ort = substr($ort,0,3);
            $ort = 'Zimmer: '.$ort;
        }
        elseif($ort == 'A06'){
            $ort = 'Anbau Zimmer: '.$ort;
        }
        else{
            $ort = $this->externeOrte[$ort];
        }

        return $ort;
    }

    /**
     * verbessern der Fachbezeichnung und der Hintergrundfarbe
     *
     * @param $fach
     * @return array
     */
    protected function umbenennenFach($fach)
    {
        if(array_key_exists($fach, $this->fachDetail)){

            $fachDetail = $this->fachDetail[$fach];
            $fachDetail['fach'] = $fachDetail['fach'];

            if(in_array($fach, $this->textFarbe))
                $fachDetail['text'] = '#ffffff';
            else
                $fachDetail['text'] = '#000000';

            return $fachDetail;
        }
        else{
            // unbekanntes Fach
            return array(
                'fach' => $fach,
                'farbe' => '#ffffff',
                'text' => '#000000'
            );
        }
    }

    /**
     * Darstellung der Stunden mit Subdomain 'stundenplan'
     *
     * @param $stundenDerKlasse
     * @param $fachDetail
     * @param $ort
     * @param $besonderheiten
     */
    protected function darstellungStundenplan($stundenDerKlasse, $fachDetail, $ort, $besonderheiten)
    {
        if (!isset($this->stundenplan[(int)$stundenDerKlasse->pl_tag][(int)$stundenDerKlasse->pl_stunde]))
            $this->stundenplan[(int)$stundenDerKlasse->pl_tag][(int)$stundenDerKlasse->pl_stunde] = '<div style="background-color: ' . $fachDetail['farbe'] . ';color: ' . $fachDetail['text'] . ';margin-bottom: 3px; padding: 5px; border: solid 1px #E6E6E6;">' . $fachDetail['fach'] . '<br>' . $ort . ' ' . $besonderheiten . '</div>';
        else
            $this->stundenplan[(int)$stundenDerKlasse->pl_tag][(int)$stundenDerKlasse->pl_stunde] .= '<div style="background-color: ' . $fachDetail['farbe'] . ';color: ' . $fachDetail['text'] . '; margin-bottom: 3px; padding: 5px; border: solid 1px #E6E6E6;">' . $fachDetail['fach'] . '<br>' . $ort . ' ' . $besonderheiten . '</div>';

        return;
    }

    /**
     * Darstellung der Vertretungsstunden
     *
     * @param $stundenDerKlasse
     * @param $fachDetail
     * @param $ort
     * @param $besonderheiten
     */
    protected function darstellungVertretungsplan($stundenDerKlasse, $fachDetail, $ort, $besonderheiten)
    {
        // Lehrer
        $lehrer = $stundenDerKlasse->pl_lehrer;
        $lehrer = $this->ermittelnLehrer($lehrer);

        // Veränderung
        if( ($stundenDerKlasse->pl_fach->attributes()) or ($stundenDerKlasse->pl_lehrer->attributes()) ){
            if (!isset($this->stundenplan[(int)$stundenDerKlasse->pl_tag][(int)$stundenDerKlasse->pl_stunde]))
                $this->stundenplan[(int)$stundenDerKlasse->pl_tag][(int)$stundenDerKlasse->pl_stunde] = '<div style="background-color: ' . $this->colorVertretungsplan['aenderung'] . ';color: ' . $this->colorVertretungsplan['weiss'] . ';margin-bottom: 3px; padding: 5px; border: solid 1px #E6E6E6;">' . $fachDetail['fach'] . '<br>' . $ort . ' '. '<br>' . $lehrer. '<br>' . $besonderheiten . '</div>';
            else
                $this->stundenplan[(int)$stundenDerKlasse->pl_tag][(int)$stundenDerKlasse->pl_stunde] .= '<div style="background-color: ' . $this->colorVertretungsplan['aenderung'] . ';color: ' . $this->colorVertretungsplan['weiss'] . ';margin-bottom: 3px; padding: 5px; border: solid 1px #E6E6E6;">' . $fachDetail['fach'] . '<br>' . $ort . ' '. '<br>' . $lehrer. '<br>' . $besonderheiten . '</div>';
        }
        // normale Darstellung
        else{
            if (!isset($this->stundenplan[(int)$stundenDerKlasse->pl_tag][(int)$stundenDerKlasse->pl_stunde]))
                $this->stundenplan[(int)$stundenDerKlasse->pl_tag][(int)$stundenDerKlasse->pl_stunde] = '<div style="background-color: ' . $this->colorVertretungsplan['karte'] . ';color: ' . $this->colorVertretungsplan['text'] . ';margin-bottom: 3px; padding: 5px; border: solid 1px #E6E6E6;">' . $fachDetail['fach'] . '<br>' . $ort . ' '. '<br>' . $lehrer. '<br>' . $besonderheiten . '</div>';
            else
                $this->stundenplan[(int)$stundenDerKlasse->pl_tag][(int)$stundenDerKlasse->pl_stunde] .= '<div style="background-color: ' . $this->colorVertretungsplan['karte'] . ';color: ' . $this->colorVertretungsplan['text'] . ';margin-bottom: 3px; padding: 5px; border: solid 1px #E6E6E6;">' . $fachDetail['fach'] . '<br>' . $ort . ' '. '<br>' . $lehrer. '<br>' . $besonderheiten . '</div>';
        }


        return;
    }

    /**
     * ermittelt den Lehrer im Klartext
     *
     * @param $lehrer
     * @return mixed
     */
    protected function ermittelnLehrer($lehrer)
    {

        return $lehrer;
    }
}