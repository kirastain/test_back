<?php
include 'access.php';

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
        $sqlTrunc = "TRUNCATE TABLE maindata";
        $trunc = $myDb->prepare($sqlTrunc);
        $trunc->execute();
        while ($line = fgetcsv($file)) {
            $num = count($line);
            if ($num == $cells && is_numeric($line[0]) == true && is_numeric($line[2])) {
                $sqlNew = "INSERT INTO maindata (id, main_data, parent_id) VALUES (:id, :newData, :parentId)";
                $result = $myDb->prepare($sqlNew);
                $result->execute(array(':id' => $line[0],  ':newData' => $line[1], ':parentId' => $line[2]));
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