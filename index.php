<?php
require_once("config.php");
require_once("data/channel.DAO.php");
require_once("data/world.DAO.php");
require_once("data/map.DAO.php");
require_once("data/tracking.DAO.php");
require_once("data/spawn.DAO.php");

$channelDAO = new channelDAO();
$worldDAO = new worldDAO();
$mapDAO = new mapDAO();
$trackingDAO = new trackingDAO();
$spawnDAO = new spawnDAO();


$stateArray = ["","Stage 1", "Stage 2", "Not Killed", "Unknown"];
$mapsArray = $mapDAO->getAllMapsArray();
$worldsArray = $worldDAO->getAllWorldsArray();

$trackingContainer = $trackingDAO->getAllTrackings();
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('partials/header.partial.php'); ?>
</head>
<body>
<?php include('partials/navbar.partial.php'); ?>
<div class="container">
    <table class="table table-hover table-bordered">
        <thead>
        <th style="width: 5%;text-align: center">World</th>
        <th style="width: 20%;text-align: center">Map Name</th>
        <th style="width: 5%;text-align: center">Channel</th>
        <th style="width: 10%;text-align: center;">State</th>
        <th style="width: 10%;text-align: center;">Vanish Time</th>
        <th style="width: 10%;text-align: center;">CurCount</th>
        <th style="width: 10%;text-align: center;">Remaining</th>
        <th style="width: 10%;text-align: center;">Start Btn</th>
        <th style="width: 20%;text-align: center;">End Btns</th>
        </thead>
        <?php foreach ($trackingContainer as $k => $value) :
            $splitKey = explode("-", $k);
            $worldID = $splitKey[0];
            $channelNumber = $splitKey[1];
            $mapID = $splitKey[2];
            $spawns = $spawnDAO->getSpawnsByTracking($worldID, $channelNumber, $mapID);
            if (sizeof($spawns) > 0){
                $state = $spawns[0]->getResult();
                if ($state == 3) {
                    for ($i = 0; $i < sizeof($spawns); $i++) {
                        if ($spawns[$i]->getResult() != 3){
                            $state = $spawns[$i]->getResult();
                            break;
                        }
                    }
                }
                $vanishTime = $spawns[0]->getDefeat();
                $curCount = 0;
                $remaining = ">5";
                for ($i = 0; $i < sizeof($spawns); $i++) {
                    if ($spawns[$i]->getResult() == $state) {
                        $curCount++;
                    } else if ($spawns[$i]->getResult() == 3) {
                        continue;
                    } else {
                        break;
                    }
                }
                if ($state == 2) {
                    $remaining = 5 - $curCount;
                }
                if ($state == 4) {
                    $vanishTime = "-";
                    $curCount = "-";
                    $remaining = "-";
                }
            } else {
                $state = 4;
                $vanishTime = "-";
                $curCount = "-";
                $remaining = "-";
            }
            ?>
            <tr>
                <td style="text-align: center"><?php print $worldsArray[$worldID]; ?></td>
                <td style="text-align: center"><?php print $mapsArray[$mapID]; ?></td>
                <td style="text-align: center"><?php print $channelNumber; ?></td>
                <td style="text-align: center"><?php print $stateArray[$state] ;?></td>
                <td style="text-align: center"><?php print $vanishTime ;?></td>
                <td style="text-align: center"><?php print $curCount ;?></td>
                <td style="text-align: center"><?php print $remaining ;?></td>
                <td style="text-align: center"><form action="index.php" method="post"><input type="hidden" name="spawnAction" value="<?php print $worldID . "-". $channelNumber . "-" . $mapID; ?>"><input type="submit" value="Spawned"></form></td>
                <td style="text-align: center"><form action="index.php" method="post"><input type="hidden" name="stage1" value="<?php print $worldID . "-". $channelNumber . "-" . $mapID; ?>"><input type="submit" value="Stage 1"></form>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


</body>
</html>
