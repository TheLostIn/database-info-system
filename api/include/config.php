<?php

use Medoo\Medoo;

$db = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'student',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8'
]);
$db1 = new mysqli('localhost', 'root', '', 'student');
mysqli_select_db($db1,"xml");
mysqli_query($db1,"set names 'utf8'");
if (mysqli_connect_errno())
{
    echo '<p>' . 'Connect DB error';
    exit;
}