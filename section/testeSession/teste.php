<?php


/*session_start();
$_SESSION["name"] ="pedro";
echo $_SESSION["name"]."<br>";
echo session_id();
unset( $_SESSION["name"]);
session_destroy();
echo session_id();
echo "<br>Pedro";*/

session_start();
if(!isset($_SESSION["cid"])){
    $_SESSION["cid"] = "Pedrinho City";
}

echo $_SESSION["cid"];

unset($_SESSION["cid"]);
session_destroy();
?>