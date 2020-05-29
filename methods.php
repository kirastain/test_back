<?php
include 'access.php';
include 'get_row.php';
include 'get_table.php';
include 'update_row.php';
include 'get_heads.php';
include 'update_heads.php';
include 'delete_rows.php';


/*class DataNode {
    //public $Id; //look up if it's needed or it's created automatically
    public  $mainData;
    public  $parentId;
    public  $createDate;
} */

class IdException extends Exception {
    // Переопределим исключение так, что параметр message станет обязательным
    public function __construct($message, $code = 0, Exception $previous = null) {
        // некоторый код

        // убедитесь, что все передаваемые параметры верны
        parent::__construct($message, $code, $previous);
    }

    // Переопределим строковое представление объекта.
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function customFunction() {
        echo "Мы можем определять новые методы в наследуемом классе\n";
    }
}
