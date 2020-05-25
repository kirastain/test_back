<?php

function deleteById(int $currentId): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    try {
        $sqlSearch = 'SELECT id FROM maindata WHERE parent_id = :parentId';
        $row = $myDb->prepare($sqlSearch);
        $row->execute(array(':parentId' => $currentId));
        $rowId = $row->fetch(PDO::FETCH_ASSOC)["id"];
        print($rowId . " is rowid\n");
        print("Now deleting " . $currentId . "\n");
        if ($rowId) {
            print("Child id is " . $rowId . "\n");
            deleteById($rowId);
        } else {
            //print("Now deleting " . $currentId . "\n");
            /*$sqlDelete = 'DELETE FROM maindata WHERE id = :currentId';
            $result = $myDb->prepare($sqlDelete);
            $result->execute(array(':currentId' => $currentId));*/
        }
    } catch (\Exception $e) {
        var_dump($e->getMessage());
    }
}