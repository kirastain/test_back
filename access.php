<?php
$username = 'postgres';
$password = '1410';

$myDb = new PDO('pgsql:host=localhost;dbname=testdb', $username, $password);
