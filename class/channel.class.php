<?php

class Channel
{
    private $worldID;
    private $channelNumber;

    public function __construct($worldID, $channelNumber)
    {
        $this->worldID = $worldID;
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

    public function setWorldID($worldID)
    {
        $this->worldID = $worldID;
    }

    public function setChannelNumber($channelNumber)
    {
        $this->channelNumber = $channelNumber;
    }

}