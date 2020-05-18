<?php

include 'access.php';

/*class DataNode {
    //public $Id; //look up if it's needed or it's created automatically
    public  $mainData;
    public  $parentId;
    public  $createDate;
} */

/**
 *
 */

function printTable(): void
{
    global $MYDB;

    try {
        $table = $MYDB->query('SELECT * FROM maindata'); //PDOStatement
        if (!$table)
            throw new Exception("Table not found");
        $result = $table->fetchAll(PDO::FETCH_ASSOC);
        print(json_encode($result, JSON_PRETTY_PRINT));
    } catch (Exception $e) {
        print("Error: " . $e->getMessage() . "\n");
    }
}

/**
 * @param int $currentId
 */

function printById(int $currentId): void
{
    global $MYDB;

    try {
        $line = $MYDB->query("SELECT * FROM maindata WHERE id=$currentId");
        if (!$line)
            throw new Exception("No such id");
        $result = $line->fetch(PDO::FETCH_ASSOC);
        print(json_encode($result, JSON_PRETTY_PRINT));
    } catch (Exception $e) {
        print("Error: " . $e->getMessage() . "\n");
    }
}

/**
 * @param int $currentId
 * @param string $updData
 */

function updateById(int $currentId, string $updData): void
{
    global $MYDB;

    try {
        $upd = $MYDB->query("UPDATE maindata SET main_data='$updData' WHERE id=$currentId");
        if (!$upd)
            throw new Exception("Can't update");
    } catch (Exception $e) {
        print("Error: " . $e->getMessage() . "\n");
    }
}

PrintTable(); //bad getaway when trying to view in browser
//PrintById($myDB, 1);
//UpdateById($myDB, 1, "edited");
