<?php
session_start();

header("Location: ../top/top.html");

$_SESSION = array();

@session_destroy();
?>