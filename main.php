<?php

$myDB = new PDO('pgsql:host=localhost;dbname=testdb', 'postgres', '1410');
$result = $myDB->query("SELECT MainData FROM maindata");
echo $result;

