<?php
include 'access.php';
require __DIR__ . '/vendor/autoload.php';
use PHPExcel;

/**
 * @throws Exception
 */
function printToXls(): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $xls = new PHPExcel();
    $xls->getProperties()->setCreator("Daria Fedorova")
        ->setTitle("Main Data");
    $xls->setActiveSheetIndex(0)
        ->setCellValue('A1', "id")
        ->setCellValue('B1', "Main Data")
        ->setCellValue('C1', "Parent id");

    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=maindata.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    try {
        $line = 2;
        $sql = "SELECT id, main_data, parent_id FROM maindata ORDER BY id";
        $table = $myDb->prepare($sql);
        $table->execute();
        $result = $table->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $xls->setActiveSheetIndex(0)
                ->setCellValue("A$line", $row["id"])
                ->setCellValue("B$line", $row["main_data"])
                ->setCellValue("C$line", $row["parent_id"]);
            $line += 1;
        }
        $objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel5');
        $objWriter->save('php://output');
    } catch (\PDOException $e) {
        throw new Exception("An error occurred while converting to .xls\n");
    }
}

printToXls();