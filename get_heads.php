<?php
include 'access.php';

/**
 * @param int $currentId
 * @throws Exception
 */
function printHeads(int $currentId): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    try {
        $sql = 'SELECT * FROM heads WHERE dep_id = :currentId';
        $heads = $myDb->prepare($sql);
        $heads->execute(array(':currentId' => $currentId));
        $result = $heads->fetchAll(PDO::FETCH_ASSOC);
        print(json_encode($result, JSON_PRETTY_PRINT));
    } catch (\PDOException $e) {
        var_dump($e->getMessage());
        throw new Exception('An error occurred while printing heads\n');
    }
}

$currentId = $_GET["id"];
if (!isset($currentId)) {
    throw new Exception("Can't access data\n");
}
$currentId = (int)$currentId;
printHeads($currentId);