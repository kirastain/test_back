<?php
include 'access.php';

function addRow(string $newData, int $parentId): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    try {
        $sql = "INSERT INTO maindata (main_data, parent_id) VALUES (:newData, :parentId)";
        $result = $myDb->prepare($sql);
        $result->execute(array(':newData' => $newData, ':parentId' => $parentId));
    } catch (\PDOException $e) {
        throw new PDOException("Error adding data: " . $e);
    }
}

$newData = $_POST["main_data"];
$parentId = $_POST["parent_id"];
if (!isset($newData) || !isset($parentId)) {
    throw new Exception("No data to add\n");
}
$parentId = (int)$parentId;
addRow($newData, $parentId);