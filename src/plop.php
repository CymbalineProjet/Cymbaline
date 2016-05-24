<?php
session_start();
$_SESSION['post'] = $_POST;
sleep(2);
var_dump($_SESSION);