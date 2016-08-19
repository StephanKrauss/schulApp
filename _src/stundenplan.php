<?php

class lesenStundenplan extends standard
{

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
        $reader->open('../_plaene/stundenplanXml/'.$this->datei);

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
    protected function tabelleErstellen($klKurz)
    {
        $tabelle = '<table class="table table-bordered">';

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

        $tabelle .= '<a href="#top" style="text-decoration: none; color: #000000;" class="navigation"> >> nach oben << </a>  &nbsp; ';
        // $tabelle .= '<input type="button" value=">> drucken <<" onclick="printDiv(\''.$klKurz.'\')" class="navigation hidden-sm hidden-xs">';

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
        $lehrer = (string) $lehrer;

        if(array_key_exists($lehrer, $this->lehrer))
            return $this->lehrer[$lehrer];
        else
            return $lehrer;
    }
}