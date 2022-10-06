<?php
if (!$_SESSION["IsLoggedIn"])
    header("http://andcar.lt");
if (!isset($_GET['Messages']) && !isset($_GET['Favourites']))
    header("http://andcar.lt");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
</head>

<body>
    <?php
    include("../header.php");
    ?>
    <hr>
    <content>

    </content>
</body>

</html>