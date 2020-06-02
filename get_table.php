<?php
include 'access.php';

/**
 * @throws Exception
 */
function printTable(): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    try {
        $sql = "SELECT * FROM maindata ORDER BY id";
        $table = $myDb->prepare($sql);
        $table->execute();
        $result = $table->fetchAll(PDO::FETCH_ASSOC);
        print(json_encode($result, JSON_PRETTY_PRINT));
    } catch (\PDOException $e) {
        var_dump($e->getMessage());
        throw new Exception('An error occurred while printing the table\n');
    }
}

printTable();