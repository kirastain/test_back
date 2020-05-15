<?php

class       DataNode {
    //public $Id; //look up if it's needed or it's created automatically
    public  $mainData;
    public  $parentId;
    public  $createDate;
}

function    printTable($testDB)
{
    $table = $testDB->query('SELECT * FROM maindata'); //PDOStatement
    if ($table) {
        $result = $table->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            print(json_encode($row, JSON_PRETTY_PRINT));
        }
    } else {
        print("Table not found\n");
    }
}

function    printTableId($testDB, $currentId)
{
    $line = $testDB->query("SELECT * FROM maindata WHERE id=$currentId");
    if ($line) {
        $result = $line->fetch(PDO::FETCH_ASSOC);
        print(json_encode($result, JSON_PRETTY_PRINT));
    } else {
        print("id not found\n");
    }
}

function    updateTableId($testDB, $currentId, $updData)
{
    $upd = $testDB->query("UPDATE maindata SET main_data='$updData' WHERE id=$currentId");
    if ($upd) {
        printTableId($testDB, $currentId);
    } else {
        print("Error updating data\n");
    }
}

$myDB = new PDO('pgsql:host=localhost;dbname=testdb', 'postgres', '1410');
//PrintTable($myDB); //bad getaway when trying to view in browser
//PrintTableId($myDB, 1);
UpdateTableId($myDB, 2, "edited data");

