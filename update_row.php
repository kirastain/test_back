<?php

/**
 * @param int $currentId
 * @param string $updData
 * @throws Exception
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
    } catch (\PDOException $e) {
        var_dump(($e->getMessage()));
        throw new Exception('Wrong id\n');
    }
}

//$currentId = (int)$_POST["id"];
//$upData = (string)$_POST["main_data"];
//updateById($currentId, $updData);