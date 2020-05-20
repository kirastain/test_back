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
        $sql = "SELECT * FROM maindata";
        $table = $myDb->prepare($sql);
        $table->execute();
        $result = $table->fetchAll(PDO::FETCH_ASSOC);
        print(json_encode($result, JSON_PRETTY_PRINT));
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
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
        $sql = "SELECT * FROM maindata WHERE id = :currentId";
        $line = $myDb->prepare($sql);
        $line->execute(array(':currentId' => $currentId));
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
        $sql = "UPDATE maindata SET main_data = :updData WHERE id = :currentId";
        $upd = $myDb->prepare($sql);
        $upd->execute(array(':updData' => $updData, ':currentId' => $currentId));
        printById($currentId);
    } catch (Exception $e) {
        var_dump(($e->getMessage()));
    }
}
