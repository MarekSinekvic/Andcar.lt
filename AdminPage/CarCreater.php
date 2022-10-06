<?
if (isset($_POST["AddNewCar2"])) {
    var_dump($_POST["files"]);
    $path = "Car" . (count(scandir("../Cars/Images")) - 2) . "_" . $photosNames[$i];
    copy($_POST["files"][0], "../Cars" . $path);
}
