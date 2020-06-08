<?php
include 'access.php';
include 'update_row.php';
include 'add_row.php';

/**
 * @param $file
 * @throws Exception
 */
function fromCsv($file): void
{
    global $myDb;
    $cells = 3;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $myDb->beginTransaction();
    try {
        while ($line = fgetcsv($file)) {
            $num = count($line);
            print ($line[2] . "\n");
            if ($num == $cells && is_numeric($line[0]) == true) {
                $sql = "SELECT id FROM maindata WHERE id = :id";
                $exists = $myDb->prepare($sql);
                $exists->execute(array(':id' => (int)$line[0]));
                $result = $exists->fetch(PDO::FETCH_ASSOC);
                if (isset($result["id"])) {
                    updateById($line[0], $line[1], $line[2]);
                } else {
                    addRow($line[1], $line[2]);
                }
            }
            else {
                throw new PDOException('Wrong data format');
            }
        }
        $myDb->commit();
    } catch (\PDOException $e) {
        $myDb->rollBack();
        throw new PDOException("Can't update the database: " . $e);
    }
}

$file = fopen('./data.csv', 'r'); //или лучше брать и проверять через $_FILES?
if (isset($file)) {
    fromCsv($file);
} else {
    throw new Exception("Error updating the database: " . $e);
}
fclose($file);