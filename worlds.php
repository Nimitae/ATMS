<?php
require_once("config.php");
require_once("data/world.DAO.php");

$worldDAO = new WorldDAO();

if (isset($_POST["worldName"]) && !empty($_POST["worldName"])) {
    $worldDAO->insertWorld($_POST["worldName"]);
}

$worldContainer = $worldDAO->getAllWorlds();
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
            <th style="width:10%;text-align: center">WorldID</th>
            <th style="width: 90%;">WorldName</th>
            </thead>
            <?php foreach ($worldContainer as $world) : ?>
                <tr>
                    <td style="text-align: center"><?php print $world->getWorldID() ?></td>
                    <td><?php print $world->getWorldName() ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <hr>
        <form class="pull-right" action="worlds.php" method="post">
            <input type="text" placeholder="World Name" name="worldName">
            <input type="submit" value="Add">
        </form>
    </div>
</div>
</body>
</html>