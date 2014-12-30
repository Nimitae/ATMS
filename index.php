<?php
require_once("config.php");
require_once("data/tracking.DAO.php");

$trackingDAO = new trackingDAO();
$trackingContainer = $trackingDAO->getAllTrackings();
var_dump($trackingContainer);
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('partials/header.partial.php'); ?>
</head>
<body>
<?php include('partials/navbar.partial.php'); ?>


</body>
</html>
