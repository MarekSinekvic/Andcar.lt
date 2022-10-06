<?php
include("../main.php");
if (!isset($_GET["id"])) {
    header("http://andcar.lt");
}
$imageId = 0;
$sellerIP = "127.0.0.1";

class User
{
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Andcar</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='header.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='content.css'>
    <!-- <script src='main.js'></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
    <header>
        <div id="title">
            <div id="logo"></div>
            <div id="name">Andcar</div>
        </div>
        <div id="navigation-board">
            <span id="Home"><a href="http://andcar.lt/">Home</a></span>
            <span id="write_to_seller_link"><a href="http://andcar.lt/">Chat</a></span>
        </div>
    </header>
    <hr /><br />
    <content>
        <div id="Chat">
            <?php
            if ($_SERVER['REMOTE_ADDR'] == $sellerIP) {
                $messagesTable = $mainDbHandler->query("SELECT * FROM `chat` ORDER BY `Name`");
                $lastName = "";
                for ($i = 0; $i < $messagesTable->num_rows; $i++) {
                    $messagesTable->data_seek($i);
                    $message = $messagesTable->fetch_array();
                    if ($lastName != $message["Name"]) {
                        $messageTexts = explode(';', $message["Text"]);
                        $lastIndex = count($messageTexts) - 1;
                        echo <<<USERS
                            <div class="user">
                                <div class="name">{$message["Name"]}</div>
                                <div class="lastmessage">$messageTexts[$lastIndex]</div>
                            </div>
USERS;
                        $lastName = $message["Name"];
                    } else {
                    }
                }
            } else {
            }

            ?>
        </div>
    </content>

    <script>
        function changeMainPreviewImageOn(src) {
            document.getElementById("mainPreviewImage").src = src;
        }
    </script>
</body>

</html>
<?php
if (isset($_GET['send-message'])) {
    sendMessage($_GET['message-name'], $_GET['message-email'], $_GET['message-text'], "0", $mainDbHandler);
    echo $_SERVER['REMOTE_ADDR'];
}
function sendMessage($name, $email, $text, $target, $dbHandler)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && $name != "Seller") {
        $carID = $_GET['id'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $sqlRequest = "INSERT INTO `chatincarpage`(`CarID`, `Name`, `Email`, `Text`, `IP`, `MessageTarget`) VALUES ($carID,'$name','$email','$text','$ip','$target')";
        $dbHandler->query($sqlRequest);
    } else {
        echo "Incorrect email address";
    }
}
?>