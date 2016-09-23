<?php

/**
 * Created by PhpStorm.
 * User: PC Stephan
 * Date: 23.09.2016
 * Time: 11:20
 */
class kollegenplan extends standard
{
    protected $datei = null;
    protected $lehrerKurz = null;
    protected $tabelle = '';

    /**
     * Namen der Lehrer für Template Engine
     *
     * @return array
     */
    public function lehrerTabelle()
    {
        $lehrerTabelle = [];

        $i = 0;
        foreach($this->lehrer as $lehrerKurz => $lehrerLang){
            $lehrerTabelle[$i]['kurz'] = $lehrerKurz;
            $lehrerTabelle[$i]['lang'] = $lehrerLang;

            $i++;
        }

        return $lehrerTabelle;
    }

    /**
     * ermittelt die Stunden eines Lehrer
     *
     * @param $lehrer
     * @return $this
     */
    public function ermittelnStundenLehrer($lehrer)
    {
        $this->lehrerKurz = $lehrer;

        $flagDateiName =  $this->ermittelnNameXmlDatei();

        if($flagDateiName != false){
            // Speicher löschen
            $this->stundenplan = [];

            // erste Zeile der Tabelle mit den Wochentagen
            $this->erstellenWochentage();

            // Auswertung XML
            $this->auswertungXml($lehrer);

            // Tabelle zeichnen
            $this->tabelleErstellen();
        }

        return $this;
    }

    /**
     * ermittelt den Namen der XML Datei
     *
     * @return array|bool|string
     */
    protected function ermittelnNameXmlDatei()
    {
        $dateien = scandir('../_plaene/stundenplanXml/');

        for($i = 0; $i < count($dateien); $i++){
            if(!strstr($dateien[$i],'.xml'))
                unset($dateien[$i]);
        }

        $dateien = array_merge($dateien);

        if(count($dateien) != 1)
            return false;
        else{
            $this->datei = $dateien[0];

            return $dateien[0];
        }

    }

    /**
     * Auswertung der Stunden des Lehrer
     */
    protected function auswertungXml($lehrer)
    {
        $reader = new XMLReader;
        $reader->open('../_plaene/stundenplanXml/'.$this->datei);

        while($reader->read()){

            // Überschrift
            if($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'kopf'){
                $kopf = simplexml_load_string($reader->readOuterXml());

                $this->tabelle .= '<h5>g&uuml;ltig ab: '.$kopf->gueltigab.'</h5>';
            }

            // Zeiten
            if($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'zeitraster') {
                $this->ermittelnZeiten($reader);
            }

            if($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'le'){

                $kollegenplan = simplexml_load_string($reader->readOuterXml());
                $kollege = (array) $kollegenplan->children();

                if($kollege['le_kurz'] == $this->lehrerKurz){
                    $stunden = $kollege['le_plan'];
                    $this->stundenDesKollege($stunden);
                }
            }
        }

        return;
    }

    /**
     * erste Zeile der Tabelle mit den Wochentagen
     */
    protected function erstellenWochentage()
    {
        for($i = 0; $i < count($this->tage); $i++){
            $this->stundenplan[0][$i] = $this->tage[$i];
        }

        return;
    }

    /**
     * erstellen der ersten Spalte mit den Stunden
     */
    protected function erstellenStunden()
    {



        return;
    }

    /**
     * @return string
     */
    public function getTabelle()
    {
        return $this->tabelle;
    }

    /**
     * Ermittelt die Zeiten der Schulstunden
     *
     * @param $reader
     */
    protected function ermittelnZeiten($reader)
    {
        $zeitraster = simplexml_load_string($reader->readOuterXml());
        $zrStunden = $zeitraster->children();

        for ($i = 0; $i < count($zrStunden); $i++) {
            $attribute = (array)$zrStunden[$i]->attributes();
            $stunde = $i + 1;

            $this->stundenplan[$i + 1][0] = $stunde . '.<br>' . $attribute['@attributes']['zr_zeit'];
        }
    }

    /**
     * Stunden des Kollegen
     *
     * @param $stunden
     */
    protected function stundenDesKollege($stunden)
    {
        for($i = 0; $i < count($stunden->pl); $i++)
        {
            $stunde = $stunden->pl[$i];

            $elemente = (array) $stunde->children();

            if(!is_array($elemente['pl_klasse'])){
                $klassen = $elemente['pl_klasse'];
            }
            else{
                $klassen = '';

                for($j = 0; $j < count($elemente['pl_klasse']); $j++){
                    $klassen .= $elemente['pl_klasse'][$j];

                    if($j < (count($elemente['pl_klasse']) - 1))
                        $klassen .= '<br>';
                }
            }

            $fach = $elemente['pl_fach'];
            $raum = $elemente['pl_raum'];

            $this->stundenplan[$elemente['pl_stunde']][$elemente['pl_tag']] = $klassen.'<br>'.$fach.'<br>'.$raum;
        }

        return;
    }

    protected function tabelleErstellen()
    {
        for($i = 0; $i < count($this->stundenplan); $i++){
            if($i == 0){
                $this->tabelle .= '<thead><tr>';

                foreach($this->stundenplan[0] as $kopf){
                    $this->tabelle .= '<th>'.$kopf.'</th>';
                }

                $this->tabelle .= '</tr></thead>';
            }
            else{
                if($i == 1)
                    $this->tabelle .= '<tbody>';

                $this->tabelle .= '<tr>';

                for($j = 0; $j < 6; $j++){


                    if(array_key_exists($j,$this->stundenplan[$i]))
                        $this->tabelle .= '<td>'.$this->stundenplan[$i][$j].'</td>';
                    else
                        $this->tabelle .= '<td> &nbsp; </td>';
                }

                $this->tabelle .= '</tr>';
            }
        }

        $this->tabelle .= '</tbody>';

        return;
    }

    /**
     * @return mixed
     */
    public function getLehrer()
    {
        return $this->lehrer[$this->lehrerKurz];
    }
}