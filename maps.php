<?php
require_once("config.php");
require_once("data/map.DAO.php");

$mapDAO = new mapDAO();

if (isset($_POST["mapName"]) && !empty($_POST["mapName"])) {
    $mapDAO->insertMap($_POST["mapName"]);
}

$mapContainer = $mapDAO->getAllMaps();
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('partials/header.partial.php'); ?>
</head>
<body>
<?php include('partials/navbar.partial.php'); ?>
<div class="container">
    <div class="col-sm-6 col-md-offset-3">
        <table class="table table-hover table-bordered">
            <thead>
            <th style="width:10%;text-align: center">MapID</th>
            <th style="width:90%">MapName</th>
            </thead>
            <?php foreach ($mapContainer as $map) : ?>
                <tr>
                    <td style="text-align: center"><?php print $map->getMapID() ?></td>
                    <td><?php print $map->getMapName() ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <hr>
        <form class="pull-right" action="maps.php" method="post">
            <input type="text" placeholder="Map Name" name="mapName">
            <input type="submit" value="Add">
        </form>
    </div>
</div>
</body>
</html>