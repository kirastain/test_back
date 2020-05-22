<?php

function updateHeads(int $currentId, array $headsList): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    try {
        $sql = 'UPDATE heads SET dep_id = :currentId WHERE head_name = :headName';
        foreach ($headsList as $headName) {
            $upd = $myDb->prepare($sql);
            $upd->execute(array(':currentId' => $currentId, ':headName' => $headName));
        }
        printHeads($currentId);
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}

//$currentId = $_POST['id'];
//$updHeads = $_POST['name'];
//updateHeads($currentId, $updHeads);