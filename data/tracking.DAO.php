<?php

class trackingDAO
{
    public function getAllTrackings()
    {
        $sqlQuery = "SELECT * FROM tracking ORDER BY worldID ASC, mapID ASC, channelNumber ASC;";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $queryResultSet = $dbh->query($sqlQuery);
        $trackingResults = $queryResultSet->fetchAll(PDO::FETCH_ASSOC);
        $trackingArray = array();
        foreach ($trackingResults as $row) {
            $trackingArray[$row["worldID"] . "-" . $row["channelNumber"] . "-" . $row["mapID"]] = 1;
        }
        return $trackingArray;
    }

    public function insertTracking($worldID, $channelNumber, $mapID)
    {
        $sqlInsert = "INSERT INTO tracking VALUES (:mapID, :worldID, :channelNumber);";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->bindParam(':mapID', $mapID);
        $stmt->bindParam(':worldID', $worldID);
        $stmt->bindParam(':channelNumber', $channelNumber);
        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public function removeTracking($worldID, $channelNumber, $mapID)
    {
        $sqlInsert = "DELETE FROM tracking WHERE mapID = :mapID AND worldID = :worldID AND channelNumber= :channelNumber;";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->bindParam(':mapID', $mapID);
        $stmt->bindParam(':worldID', $worldID);
        $stmt->bindParam(':channelNumber', $channelNumber);
        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }
}