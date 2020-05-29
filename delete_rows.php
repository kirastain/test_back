<?php

/**
 * @param int $currentId
 * @throws Exception
 */
function deleteById(int $currentId): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $myDb->beginTransaction();
    try {
        $sqlSearch = 'SELECT id FROM maindata WHERE parent_id = :parentId';
        $row = $myDb->prepare($sqlSearch);
        $row->execute(array(':parentId' => $currentId));
        $childIds = $row->fetchALL(PDO::FETCH_ASSOC);
        $sqlDelete = 'DELETE FROM maindata WHERE id = :currentId';
        $result = $myDb->prepare($sqlDelete);
        $result->execute(array(':currentId' => $currentId));
        if (!empty($childIds)) {
            foreach ($childIds as $childId) {
                $childId = $childId["id"];
                deleteById($childId);
            }
        }
        $myDb->commit();
    } catch (\Exception $e) {
        var_dump($e->getMessage());
        $myDb->rollBack();
        throw new Exception("Can't delete\n");
    }
}

try {
    $currentId = (int)$_POST["id"];
    if (isset($currentId)) {
        deleteById($currentId);
    }
} catch (\Exception $e) {
    throw new Exception(("Wrong id\n"));
}