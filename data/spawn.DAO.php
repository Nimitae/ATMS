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
            $newSpawn = new Spawn($row["spawnID"],$row["mapID"], $row["worldID"], $row["channelNumber"], $row["start"], $row["defeat"], $row["result"]);
            $spawnArray[] = $newSpawn;
        }
        return $spawnArray;

    }

    public function insertNewSpawn($worldID, $channelNumber, $mapID, $start, $result)
    {
        $sqlInsert = "INSERT INTO spawn VALUES (NULL, :mapID, :worldID, :channelNumber, :start, NULL, :result);";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->bindParam(':mapID', $mapID);
        $stmt->bindParam(':worldID', $worldID);
        $stmt->bindParam(':channelNumber', $channelNumber);
        $stmt->bindParam(':start', $start);
        $stmt->bindParam(':result', $result);
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
        $sqlInsert = "UPDATE spawn SET defeat =:defeat, result =:result WHERE spawnID =:spawnID;";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->bindParam(':spawnID', $spawn->getSpawnID());
        $stmt->bindParam(':defeat', $spawn->getDefeat());
        $stmt->bindParam(':result', $spawn->getResult());
        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public function getSpawnBySpawnID($spawnID)
    {
        $sqlQuery = "SELECT * FROM spawn WHERE spawnID = :spawnID;";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sqlQuery);
        $stmt->bindParam(':spawnID', $spawnID);
        $stmt->execute();
        $spawnResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $spawnArray = array();
        foreach ($spawnResults as $row) {
            $newSpawn = new Spawn($row["spawnID"],$row["mapID"], $row["worldID"], $row["channelNumber"], $row["start"], $row["defeat"], $row["result"]);
            $spawnArray[] = $newSpawn;
        }
        return $spawnArray[0];
    }
}