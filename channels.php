<?php
require_once("config.php");
require_once("data/channel.DAO.php");
require_once("data/world.DAO.php");

$channelDAO = new channelDAO();
$worldDAO = new worldDAO();
if (isset($_POST["worldID"]) && !empty($_POST["worldID"]) && isset($_POST["channelNumber"]) && !empty($_POST["channelNumber"])) {
    $channelDAO->insertChannel($_POST["worldID"], $_POST["channelNumber"]);
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
            <th style="width:10%;text-align: center">World</th>
            <th style="width:90%">ChannelNumber</th>
            </thead>
            <?php foreach ($worldContainer as $world) :
                $worldChannels = $channelDAO->getWorldChannels($world->getWorldID());
                if (sizeof($worldChannels) > 0) :
                    ?>
                    <tr>
                        <td rowspan="<?php print sizeof($worldChannels) ?>"
                            style="text-align: center;vertical-align:middle;"><?php print $world->getWorldName() ?></td>
                        <td><?php print $worldChannels[0]->getChannelNumber(); ?></td>
                    </tr>
                    <?php for ($i = 1; $i < sizeof($worldChannels); $i++) : ?>
                    <tr>
                        <td><?php print $worldChannels[$i]->getChannelNumber(); ?></td>
                    </tr>
                <?php endfor; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
        <hr>
        <form class="pull-right" action="channels.php" method="post">
            <select name="worldID">
                <?php foreach ($worldContainer as $world) : ?>
                    <option value="<?php print $world->getWorldID(); ?>"><?php print $world->getWorldName(); ?></option>
                <?php endforeach; ?>
            </select>
            <select name="channelNumber">
                <?php for ($i = 1; $i <= 20; $i++) : ?>
                    <option value="<?php print $i; ?>"><?php print $i; ?></option>
                <?php endfor; ?>
            </select>
            <input type="submit" value="Add">
        </form>
    </div>
</div>
</body>
</html>