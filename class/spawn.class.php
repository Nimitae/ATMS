<?php

class Spawn
{
    private $spawnID;
    private $mapID;
    private $worldID;
    private $channelNumber;
    private $start;
    private $defeat;
    private $result;

    public function __construct($spawnID,$mapID, $worldID, $channelNumber, $start, $defeat, $result)
    {
        $this->spawnID = $spawnID;
        $this->mapID = $mapID;
        $this->worldID = $worldID;
        $this->start = $start;
        $this->defeat = $defeat;
        $this->result = $result;
        $this->channelNumber = $channelNumber;
    }

    public function getWorldID()
    {
        return $this->worldID;
    }

    public function getChannelNumber()
    {
        return $this->channelNumber;
    }

    public function getMapID()
    {
        return $this->mapID;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getDefeat()
    {
        return $this->defeat;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function getSpawnID()
    {
        return $this->spawnID;
    }

    public function setMapID($mapID)
    {
        $this->mapID = $mapID;
    }

    public function setWorldID($worldID)
    {
        $this->worldID = $worldID;
    }

    public function setChannelNumber($channelNumber)
    {
        $this->channelNumber = $channelNumber;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }

    public function setDefeat($defeat)
    {
        $this->defeat = $defeat;
    }

    public function setResult($result)
    {
        $this->result = $result;
    }

    public function setSpawnID($spawnID)
    {
        $this->spawnID = $spawnID;
    }
}