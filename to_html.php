<?php
include 'access.php';

/**
 * @throws Exception
 */
function printToHtml(): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    try {
        $sql = "SELECT * FROM maindata ORDER BY id";
        $table = $myDb->prepare($sql);
        $table->execute();
        $result = $table->fetchAll(PDO::FETCH_ASSOC);
        echo "<table border='1'><tr><th>id</th><th>Main Data</th><th>Parent ID</th></tr>";
        foreach ($result as $row) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["main_data"] . "</td><td>" . $row["parent_id"] . "</td></tr>";
        }
        echo "</table>";
    } catch (\PDOException $e) {
        var_dump($e->getMessage());
        throw new Exception('An error occurred while converting to html\n');
    }
}

printToHtml();
