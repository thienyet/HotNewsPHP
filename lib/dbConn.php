<?php
function myConnect() {
    $servername = "127.0.0.1:3307";
    $username = "root";
    $password = "";
    $dbname = "vnexpress";
    $conn = mysqli_connect($servername, $username, $password);
    mysqli_select_db($conn, $dbname);
    mysqli_query($conn, "SET NAME 'utf8'");
    return $conn;
}
?>