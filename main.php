<?php

class       DataNode {
    //public $Id;
    public  $MainData;
    public  $ParentId;
    public  $CreateDate;
}

function    PrintTable($TestDB)
{
    $table = $TestDB->query('SELECT * FROM maindata'); //PDOStatement
    if ($table)
    {
        foreach ($table as $row)
        {
            print json_encode($row, JSON_PRETTY_PRINT);
        }
    }
}

function    PrintTableId($TestDB, $CurrentId)
{
    $line = $TestDB->query("SELECT * FROM maindata WHERE id=$CurrentId");
    if ($line)
    {
        foreach ($line as $row)
        {
            /*print $row['id'] . '\t';
            print $row['main_data'] . '\t';
            print $row['parent_id'] . '\t';
            print $row['create_date'] . '\t';*/
            print json_encode($row, JSON_PRETTY_PRINT);
        }
    }
}

$myDB = new PDO('pgsql:host=localhost;dbname=testdb', 'postgres', '1410');
PrintTable($myDB);
//PrintTableId($myDB, 1);


