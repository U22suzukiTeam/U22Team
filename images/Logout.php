<?php
session_start();

header("Location: top.html");

$_SESSION = array();

@session_destroy();
?>