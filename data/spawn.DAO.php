<?php
require_once("class/spawn.class.php");

class spawnDAO
{
    public function getSpawnsByTracking($worldID, $channelNumber, $mapID)
    {
        $sqlQuery = "SELECT * FROM spawn WHERE mapID = :mapID AND worldID = :worldID AND channelNumber= :channelNumber ORDER BY start DESC;";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sqlQuery);
        $stmt->bindParam(':mapID', $mapID);
        $stmt->bindParam(':worldID', $worldID);
        $stmt->bindParam(':channelNumber', $channelNumber);
        $stmt->execute();
        $spawnResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $spawnArray = array();
        foreach ($spawnResults as $row) {
            $newSpawn = new Spawn($row["mapID"], $row["worldID"], $row["channelNumber"], $row["start"], $row["defeat"], $row["result"]);
            $spawnArray[] = $newSpawn;
        }
        return $spawnArray;

    }

    public function insertNewSpawn($worldID, $channelNumber, $mapID, $start)
    {
        $sqlInsert = "INSERT INTO spawn VALUES (:mapID, :worldID, :channelNumber, :start, NULL, NULL);";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->bindParam(':mapID', $mapID);
        $stmt->bindParam(':worldID', $worldID);
        $stmt->bindParam(':channelNumber', $channelNumber);
        $stmt->bindParam(':start', $start);
        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public function updateSpawn($spawn)
    {
        /** @var Spawn $spawn */
        $sqlInsert = "UPDATE spawn SET defeat =:defeat, result =:result WHERE mapID = :mapID AND worldID = :worldID AND channelNumber= :channelNumber;";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->bindParam(':mapID', $spawn->getMapID());
        $stmt->bindParam(':worldID', $spawn->getWorldID());
        $stmt->bindParam(':channelNumber', $spawn->getChannelNumber());
        $stmt->bindParam(':defeat', $spawn->getDefeat());
        $stmt->bindParam(':result', $spawn->getResult());
        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }
}