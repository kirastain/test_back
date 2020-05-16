<?php

/*class DataNode {
    //public $Id; //look up if it's needed or it's created automatically
    public  $mainData;
    public  $parentId;
    public  $createDate;
} */

function printTable($testDB): void
{
    $table = $testDB->query('SELECT * FROM maindata'); //PDOStatement
    if ($table) {
        $result = $table->fetchAll(PDO::FETCH_ASSOC);
        print(json_encode($result, JSON_PRETTY_PRINT));
    } else {
        print("Table not found\n");
    }
}

function printById($testDB, int $currentId): void
{
    $line = $testDB->query("SELECT * FROM maindata WHERE id=$currentId");
    if ($line) {
        $result = $line->fetch(PDO::FETCH_ASSOC);
        print(json_encode($result, JSON_PRETTY_PRINT));
    } else {
        print("id not found\n");
    }
}

function updateById($testDB, int $currentId, string $updData): void
{
    $upd = $testDB->query("UPDATE maindata SET main_data='$updData' WHERE id=$currentId");
    if ($upd) {
        printById($testDB, $currentId);
    } else {
        print("Error updating data\n");
    }
}

$myDB = new PDO('pgsql:host=localhost;dbname=testdb', 'postgres', '1410');
PrintTable($myDB); //bad getaway when trying to view in browser
//PrintById($myDB, 1);
//UpdateById($myDB, 1, "edited");
