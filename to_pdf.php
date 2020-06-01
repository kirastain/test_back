<?php
include 'access.php';
require __DIR__ . '/vendor/autoload.php';
use Fpdf\Fpdf;

/**
 * @throws Exception
 */
function printToPdf(): void
{
    global $myDb;

    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    try {
        $pdf = new FPDF();
        $pdf->SetTitle('testdb Main Data');
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->AddPage('P');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetXY(20, 20);
        $pdf->SetDrawColor(50, 60, 100);
        $pdf->Cell(180, 10, 'Main Data', 1, 0, 'C', 0);
        $pdf->SetXY(20, 30);
        $pdf->Cell(60, 10, "id", 1, 0, 'C', '0');
        $pdf->Cell(60, 10, "Main Data", 1, o, 'C', '0');
        $pdf->Cell(60, 10, "Parent Id", 1, 0, 'C', '0');
        $pdf->SetXY(20, 40);
        $pdf->SetFont('Arial', '', 16);

        $columnId = "";
        $columnData = "";
        $columnParent = "";

        try {
            $sql = "SELECT id, main_data, parent_id FROM maindata ORDER BY id";
            $table = $myDb->prepare($sql);
            $table->execute();
            $result = $table->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
            throw new Exception('An error occurred while getting the table\n');
        }

        foreach ($result as $row) {
            $columnId = $columnId . $row["id"] . "\n";
            $columnData = $columnData . $row["main_data"] . "\n";
            $columnParent = $columnParent . $row["parent_id"] . "\n";
        }

        $pdf->MultiCell(60, 10, $columnId, 1, 'C', 0);
        $pdf->SetXY(80, 40);
        $pdf->MultiCell(60, 10, $columnData, 1, 'C', 0);
        $pdf->SetXY(140, 40);
        $pdf->MultiCell(60, 10, $columnParent, 1, 'C', 0);

        $pdf->Output('maindata.pdf', 'I');
    } catch (\PDOException $e) {
        throw new Exception("Error while converting to PDF\n");
    }
}

printToPdf();