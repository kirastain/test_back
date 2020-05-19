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
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    try {
        $table = $myDb->query('SELECT * FROM maidata'); //PDOStatement
        $result = $table->fetchAll(PDO::FETCH_ASSOC);
        print(json_encode($result, JSON_PRETTY_PRINT));
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
    //$result = $table->fetchAll(PDO::FETCH_ASSOC);
    //print(json_encode($result, JSON_PRETTY_PRINT));
}

/**
 * @param int $currentId
 */
function printById(int $currentId): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    try {
        $line = $myDb->query("SELECT * FROM maindata WHERE id=$currentId");
        $result = $line->fetch(PDO::FETCH_ASSOC);
        print(json_encode($result, JSON_PRETTY_PRINT));
    } catch (Exception $e) {
        var_dump(($e->getMessage()));
    }
}

/**
 * @param int $currentId
 * @param string $updData
 */
function updateById(int $currentId, string $updData): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    try {
        $upd = $myDb->query("UPDATE maidata SET main_data='$updData' WHERE id=$currentId");
        printById($currentId);
    } catch (Exception $e) {
        var_dump(($e->getMessage()));
    }
}
