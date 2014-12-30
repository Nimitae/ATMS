<?php
require_once("config.php");
require_once("data/channel.DAO.php");
require_once("data/world.DAO.php");
require_once("data/map.DAO.php");
require_once("data/tracking.DAO.php");

$channelDAO = new channelDAO();
$worldDAO = new worldDAO();
$mapDAO = new MapDAO();
$trackingDAO = new trackingDAO();
$trackingContainer = $trackingDAO->getAllTrackings();
if (isset($_POST["updateTracking"])) {
    unset($_POST["updateTracking"]);
    foreach ($_POST as $k => $value) {
        if (!isset($trackingContainer[$k])) {
            $splitKey = explode("-", $k);
            $worldID = $splitKey[0];
            $channelNumber = $splitKey[1];
            $mapID = $splitKey[2];
            $trackingDAO->insertTracking($worldID, $channelNumber, $mapID);
        }
    }
}
$worldContainer = $worldDAO->getAllWorlds();
$mapContainer = $mapDAO->getAllMaps();
$trackingContainer = $trackingDAO->getAllTrackings();


?>

<!DOCTYPE html>
<html>
<head>
    <?php include('partials/header.partial.php'); ?>
</head>
<body>
<?php include('partials/navbar.partial.php'); ?>
<form action="tracking.php" method="post">
    <input type="hidden" name="updateTracking" value="1">
    <table style="word-break:break-all;" class="table table-hover table-bordered">
        <thead>
        <th style="width:5%;text-align: center">World</th>
        <th style="width:3%;text-align:center">CN</th>
        <?php foreach ($mapContainer as $map) : ?>
            <th style="text-align:center"><?php print $map->getMapName() ?></th>
        <?php endforeach; ?>
        <th style="width:3% !important;"></th>

        </thead>

        <?php foreach ($worldContainer as $world) :
            $worldChannels = $channelDAO->getWorldChannels($world->getWorldID());
            if (sizeof($worldChannels) > 0) :
                ?>
                <tr>
                    <td rowspan="<?php print sizeof($worldChannels) ?>"
                        style="text-align: center;vertical-align:middle;"><?php print $world->getWorldName() ?></td>
                    <td style="text-align: center"><?php print $worldChannels[0]->getChannelNumber(); ?></td>
                    <?php foreach ($mapContainer as $map) : ?>
                        <td style="text-align: center"><input type="checkbox"
                                                              name="<?php print $world->getWorldID() . "-" . $worldChannels[0]->getChannelNumber() . "-" . $map->getMapID(); ?>" <?php isset($trackingContainer[$world->getWorldID() . "-" . $worldChannels[0]->getChannelNumber() . "-" . $map->getMapID()]) ? print "checked" : print ""; ?>  >
                        </td>
                    <?php endforeach; ?>
                    <td style="text-align: center"><input type="checkbox" class="row-select"
                                                          id="row_"<?php print $world->getWorldID() . "-" . $worldChannels[0]->getChannelNumber(); ?>>
                    </td>
                </tr>
                <?php for ($i = 1; $i < sizeof($worldChannels); $i++) : ?>
                <tr>
                    <td style="text-align: center"><?php print $worldChannels[$i]->getChannelNumber(); ?></td>
                    <?php foreach ($mapContainer as $map) : ?>
                        <td style="text-align: center"><input type="checkbox"
                                                              name="<?php print $world->getWorldID() . "-" . $worldChannels[$i]->getChannelNumber() . "-" . $map->getMapID(); ?>" <?php isset($trackingContainer[$world->getWorldID() . "-" . $worldChannels[$i]->getChannelNumber() . "-" . $map->getMapID()]) ? print "checked" : print ""; ?>>
                        </td>
                    <?php endforeach; ?>
                    <td style="text-align: center"><input type="checkbox" class="row-select"
                                                          id="row_"<?php print $world->getWorldID() . "-" . $worldChannels[0]->getChannelNumber(); ?>>
                    </td>
                </tr>
            <?php endfor; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
    <input class="pull-right" type="submit" value="Save">
</form>
<br><br>
<hr>
</body>
</html>