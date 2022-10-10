<?php

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $ip = "";
    switch ($id) {
        case 1:
            $ip = "62.171.171.235:27015";
            break;
        case 2:
            $ip = "62.171.171.235:27016";
            break;
        case 3:
            $ip = "62.171.171.235:27017";
            break;
        case 4:
            $ip = "62.171.171.235:27018";
            break;
        case 5:
            $ip = "62.171.171.235:27019";
            break;
        case 6:
            $ip = "62.171.171.235:27035";
            break;
        case 7:
            $ip = "62.171.171.235:27106";
            break;
        case 8:
            $ip = "62.171.171.235:27107";
            break;
        case 9:
            $ip = "62.171.171.235:27108";
            break;
        case 10:
            $ip = "62.171.171.235:27109";
            break;
    }
    header("Location: steam://connect/$ip");

}
else {
    header("Location: https://surf0.net/index.php");
}
die();

?>