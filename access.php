<?php

$username = 'postgres';
$password = '1410';

$MYDB = new PDO('pgsql:host=localhost;dbname=testdb', $username, $password);
