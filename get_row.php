<?php

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

$currentId = $_GET["id"];
printById($currentId);