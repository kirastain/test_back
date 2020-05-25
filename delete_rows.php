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
    try {
        $sqlSearch = 'SELECT id FROM maindata WHERE parent_id = :parentId';
        $row = $myDb->prepare($sqlSearch);
        $row->execute(array(':parentId' => $currentId));
        $childIds = $row->fetchALL(PDO::FETCH_ASSOC);
        print("We are in the $currentId, ");
        $sqlDelete = 'DELETE FROM maindata WHERE id = :currentId';
        $result = $myDb->prepare($sqlDelete);
        $result->execute(array(':currentId' => $currentId));
        if (!empty($childIds)) {
            foreach ($childIds as $childId) {
                $childId = $childId["id"];
                print("Going to the $childId\n");
                deleteById($childId);
            }
        }
    } catch (\Exception $e) {
        var_dump($e->getMessage());
        throw new Exception("Wrong Id\n");
    }
}