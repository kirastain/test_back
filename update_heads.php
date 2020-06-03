<?php
include 'access.php';

/**
 * @param int $currentId
 * @param array $headsList
 * @throws Exception
 */
function updateHeads(int $currentId, array $headsList): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $myDb->beginTransaction();
    try {
        $sql = 'UPDATE heads SET dep_id = :currentId WHERE head_name = :headName';
        foreach ($headsList as $headName) {
            $upd = $myDb->prepare($sql);
            $upd->execute(array(':currentId' => $currentId, ':headName' => $headName));
        }
    $myDb->commit();
    } catch (\PDOException $e) {
        var_dump($e->getMessage());
        $myDb->rollBack();
        throw new Exception('An error occurred while trying to update heads\n');
    }
}

$currentId = $_POST["id"];
$updHeads = $_POST['name'];
if (!isset($currentId)) {
    throw new Exception("Can't access data\n");
}
$currentId = (int)$currentId;
updateHeads($currentId, $updHeads);