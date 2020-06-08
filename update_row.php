<?php
include 'access.php';
include 'get_row.php';

/**
 * @param int $currentId
 * @param string $updData
 * @param int $parentId
 * @throws Exception
 */
function updateById(int $currentId, string $updData, int $parentId): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    try {
        $sql = "UPDATE maindata SET main_data = :updData, parent_id = :parentId WHERE id = :currentId";
        $upd = $myDb->prepare($sql);
        $upd->execute(array(':updData' => $updData, ':currentId' => $currentId, ':parentId' => $parentId));
        printById($currentId);
    } catch (\PDOException $e) {
        var_dump(($e->getMessage()));
        throw new Exception('Wrong id\n');
    }
}

$currentId = $_POST["id"];
$upData = $_POST["main_data"];
$updParentId = $_POST["parent_id"];
if (!isset($currentId)) {
    throw new Exception("Wrong id\n");
}
$currentId = (int)$currentId;
$updParentId = (int)$updParentId;
updateById($currentId, $upData, $updParentId);
