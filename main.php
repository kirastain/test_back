<?php
include 'methods.php';

/**
 *
 */
function userAction(): void
{
    print("Choose action:\n");
    print("1. Print the table\n");
    print("2. Print the row\n");
    print("3. Update the row\n");
    print("0. Exit\n");
    print("Action: ");
    $action = readline("Action: ");
    switch ($action) {
        case 0:
            exit();
        case 1:
            printTable();
            break;
        case 2:
            print("Id: ");
            $id = readline("Id: ");
            printById($id);
            break;
        case 3:
            print("Id: ");
            $id = readline("Id: ");
            print("New data: ");
            $data = readline("New data: ");
            updateById($id, $data);
            break;
        default:
            print("Wrong option");
            userAction();
            break;
    }
    print("\n");
    userAction();
}

userAction();
