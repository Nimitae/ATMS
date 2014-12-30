<?php
require_once("class/channel.class.php");

class ChannelDAO
{
    public function getAllChannels()
    {
        $sqlQuery = "SELECT * FROM channel ORDER BY worldID ASC;";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $queryResultSet = $dbh->query($sqlQuery);
        $channelResults = $queryResultSet->fetchAll(PDO::FETCH_ASSOC);
        $channelArray = array();
        foreach ($channelResults as $row) {
            $newChannel = new Channel($row["worldID"], $row["channelNumber"]);
            $channelArray[] = $newChannel;
        }
        return $channelArray;
    }

    public function insertChannel($worldID, $channelNumber)
    {
        $sqlInsert = "INSERT INTO channel VALUES (:worldID, :channelNumber);";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->bindParam(':worldID', $worldID);
        $stmt->bindParam(':channelNumber', $channelNumber);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getWorldChannels($worldID)
    {
        $sqlQuery = "SELECT * FROM channel WHERE worldID = :worldID;";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sqlQuery);
        $stmt->bindParam(':worldID', $worldID);
        $stmt->execute();
        $channelResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $channelArray = array();
        foreach ($channelResults as $row) {
            $newChannel = new Channel($row["worldID"], $row["channelNumber"]);
            $channelArray[] = $newChannel;
        }
        return $channelArray;
    }
}
