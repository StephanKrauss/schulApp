<?php

/**
 * Created by PhpStorm.
 * User: PC Stephan
 * Date: 18.08.2016
 * Time: 16:34
 */
class vertretungsplan extends standard
{
    protected $kopf = null;
    protected $kopfArray = [];

    protected $haupt = null;
    protected $hauptArray = [];

    /**
     * Steuerung der Vertretungspläne
     *
     * @return $this
     */
    public function steuerung()
    {
        $this->lesenXml();
        $this->schreibenKopfArray();
        $this->schreibenStundenArray();
        $this->aendernFachbezeichnung();

        return $this;
    }

    /**
     * lesen der XML Datei und extrahieren des Knoten 'kopf' und 'haupt'
     */
    protected function lesenXml()
    {
        $reader = new XMLReader;
        $reader->open('../_plaene/vertretungXml/'.$this->datei);

        while($reader->read()){

            if($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'kopf')
                $this->kopf = simplexml_load_string($reader->readOuterXml());

            if($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'haupt')
                $this->haupt = simplexml_load_string($reader->readOuterXml());
        }

        return;
    }

    /**
     * schreibt die Variablen des Kopf - Array
     */
    protected function schreibenKopfArray()
    {
        $this->kopfArray = (array) $this->kopf;
        $this->kopfArray['kopfinfo'] = (array) $this->kopfArray['kopfinfo'];

        return;
    }

    /**
     * ermittelt die Informationen der geanderten Stunde
     */
    protected function schreibenStundenArray()
    {
        for($i=0; $i < count($this->haupt->aktion); $i++){
            $this->hauptArray[$i] = (array) $this->haupt->aktion[$i];
        }

        return;
    }

    /**
     * verbessert die Bezeichnung der Fächer
     */
    protected function aendernFachbezeichnung()
    {
        for($i=0; $i < count($this->hauptArray); $i++){
            if(array_key_exists($this->hauptArray[$i]['fach'], $this->fachDetail))
                $this->hauptArray[$i]['fach'] = $this->fachDetail[$this->hauptArray[$i]['fach']]['fach'];
        }

        return;
    }

    /**
     * @return array
     */
    public function getKopf()
    {
        return $this->kopfArray;
    }

    /**
     * @return array
     */
    public function getStunden()
    {
        return $this->hauptArray;
    }


}