<?php
require_once("class/map.class.php");

class mapDAO
{
    public function getAllMaps()
    {
        $sqlQuery = "SELECT * FROM map;";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $queryResultSet = $dbh->query($sqlQuery);
        $mapResults = $queryResultSet->fetchAll(PDO::FETCH_ASSOC);
        $mapArray = array();
        foreach ($mapResults as $row) {
            $newMap = new Map($row["mapID"], $row["mapName"]);
            $mapArray[] = $newMap;
        }
        return $mapArray;
    }

    public function insertMap($mapName)
    {
        $sqlInsert = "INSERT INTO map VALUES (NULL, :mapName);";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->bindParam(':mapName', $mapName);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllMapsArray()
    {
        $sqlQuery = "SELECT * FROM map;";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $queryResultSet = $dbh->query($sqlQuery);
        $mapResults = $queryResultSet->fetchAll(PDO::FETCH_ASSOC);
        $mapArray = array();
        foreach ($mapResults as $row) {
            $mapArray[$row["mapID"]] = $row["mapName"];
        }
        return $mapArray;
    }
}