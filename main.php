<?php
$mainDbHandler = mysqli_connect("127.0.0.1:3306", "root", "", "andcar");
session_start();
// echo "root";

$cars = $mainDbHandler->query("select * from `cars`");

// $result->data_seek(1);
// $data = $result->fetch_array();
// echo $data[2];

if (!isset($_COOKIE['language'])) {
    // unset($_COOKIE['language']);
    // setcookie('language', null, -1, '/', "andcar.lt");
    setcookie("language", "English");
}
function translateTextEng($value, $db) {
    $language = $_COOKIE["language"];
    $translations = $db->query("select `{$language}` from `translations` where `English`='{$value}'");

    if ($translations) {
        return $translations->fetch_all();
    }
    return "Translation error";
}

function sendMessage($text, $target, $dbHandler)
{
    // $ip = $_SERVER['REMOTE_ADDR'];
    $carID = $_GET['id'];
    $userID = $_SESSION['ID'];
    $sqlRequest = "INSERT INTO `chat`(`SenderUserID`, `TargetSendID`, `Text`, `CarID`) VALUES ($userID,$target,'$text',$carID)";
    $dbHandler->query($sqlRequest);
}
function login($email, $password, $dbHandler)
{
    if (session_status() == PHP_SESSION_ACTIVE) {
        logout();
    }
    $sqlWithEmail = "SELECT * FROM `users` WHERE `Email`=\"$email\"";
    $sqlWithName = "SELECT * FROM `users` WHERE `Name`=\"$email\"";
    $usersTable = $dbHandler->query($sqlWithEmail);
    $user = $usersTable->fetch_array();

    if ($usersTable->num_rows > 0 && $user["Password"] == $password) {
        applySession($user);
        return "You succesfuly logged in";
    } else {
        $usersTable = $dbHandler->query($sqlWithName);
        $user = $usersTable->fetch_array();
        if ($usersTable->num_rows > 0 && $user["Password"] == $password) {
            applySession($user);
            return "You succesfuly logged in";
        } else {
            if ($usersTable->num_rows == 0 || $user["Password"] != $password)
                return "Email address or password is incorrect";
        }
    }
}
function applySession($user)
{
    $_SESSION['IsLoggedIn'] = true;
    $_SESSION['ID'] = $user["ID"];
    $_SESSION['Name'] = $user["Name"];
    $_SESSION['Email'] = $user["Email"];
    $_SESSION['Password'] = $user["Password"];
}
function register($name, $email, $password, $dbHandler)
{
    $ip = $_SERVER['REMOTE_ADDR'];

    $accountExistenceCheckSql = "SELECT * FROM `users` WHERE `Email`='$email'";
    $accountsTable = $dbHandler->query($accountExistenceCheckSql);
    $account = $accountsTable->fetch_array();
    if ($account[1] == $email) { // Rows count <= 1
        return "Email is already taken";
    }

    $date = date("Y.m.d G:i:s");
    $createAccountSql = "INSERT INTO `users`(`Name`, `Email`, `IP`, `Password`) VALUES ('$name', '$email', '$ip', '$password')";
    $dbHandler->query($createAccountSql);
    login($email, $password, $dbHandler);
    return "Your account succesfuly registered";
}
function logout()
{
    session_unset();
}
function replaceUrlOn($url)
{
    echo "<script>window.location.replace('{$url}');</script>";
}
function getUserById($id, $dbHandler)
{
    return $dbHandler->query("select * from `users` where `ID`=" . $id)->fetch_array();
}

class Car
{
    public $name;
    public $mark;
    public $model;
    public $bodyType;
    public $fuelType;
    public $description;
    public $price;
    public function __construct($Name, $Mark, $Model, $BodyType, $FuelType, $Description, $Price)
    {
        $this->name = $Name;
        $this->mark = $Mark;
        $this->model = $Model;
        $this->bodyType = $BodyType;
        $this->fuelType = $FuelType;
        $this->description = $Description;
        $this->price = $Price;
    }
}
