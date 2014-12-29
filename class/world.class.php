<?php

class World
{
    private static $idList = array();
    private $worldID;
    private $worldName;

    public function __construct($worldID, $worldName)
    {
        $this->worldID = $worldID;
        $this->worldName = $worldName;
    }

    public static function create($worldID, $worldName)
    {
        if (!isset(self::$idList[$worldID])) {
            self::$idList[$worldID] = new World($worldID, $worldName);
        }
        return self::$idList[$worldID];
    }

    public function getWorldID()
    {
        return $this->worldID;
    }

    public function getWorldName()
    {
        return $this->worldName;
    }

    public function setWorldID($worldID)
    {
        $this->worldID = $worldID;
    }

    public function setWorldName($worldName)
    {
        $this->worldName = $worldName;
    }

}