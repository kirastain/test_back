<?php
include 'access.php';

/**
 * @throws Exception
 */
function printToXls(): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=maindata.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    try {
        $sql = "SELECT id, main_data, parent_id FROM maindata ORDER BY id";
        $table = $myDb->prepare($sql);
        $table->execute();
        $result = $table->fetchAll(PDO::FETCH_ASSOC);
        print("id\tMain Data\tParent id\tDate\n");
        foreach ($result as $row) {
            foreach ($row as $cell) {
                print($cell . "\t");
            }
            print("\n");
        }
    } catch (\PDOException $e) {
        throw new Exception("An error occurred while converting to .xls\n");
    }
}

printToXls();