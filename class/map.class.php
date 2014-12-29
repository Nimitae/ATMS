<?php

class Map
{
    private static $idList = array();
    private $mapID;
    private $mapName;

    public function __construct($mapID, $mapName)
    {
        $this->mapID = $mapID;
        $this->mapName = $mapName;
    }

    public static function create($mapID, $mapName)
    {
        if (!isset(self::$idList[$mapID])) {
            self::$idList[$mapID] = new World($mapID, $mapName);
        }
        return self::$idList[$mapID];
    }

    public function getMapID()
    {
        return $this->mapID;
    }

    public function getMapName()
    {
        return $this->mapName;
    }

    public function setMapID($worldID)
    {
        $this->mapID = $worldID;
    }

    public function setMapName($worldName)
    {
        $this->mapName = $worldName;
    }

}