<?php
require_once("class/world.class.php");

class WorldDAO
{
    public function getAllWorlds()
    {
        $sqlQuery = "SELECT * FROM world;";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $queryResultSet = $dbh->query($sqlQuery);
        $ticketResults = $queryResultSet->fetchAll(PDO::FETCH_ASSOC);
        $worldArray = array();
        foreach ($ticketResults as $row) {
            $newWorld = new World($row["worldID"], $row["worldName"]);
            $worldArray[] = $newWorld;
        }
        return $worldArray;
    }

    public function insertWorld($worldName)
    {
        $sqlInsert = "INSERT INTO world VALUES (NULL, :worldName);";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->bindParam(':worldName', $worldName);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
