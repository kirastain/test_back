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
    print("4. Print heads\n");
    print("5. Update head list\n");
    print("6. Delete row and child rows\n");
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
        case 4:
            print("Id: ");
            $id = readline("Id: ");
            printHeads($id);
            break;
        case 5:
            print("Id: ");
            $id = 3;
            $updHeads = [1 => "Sauron", 2 => "Aragorn"];
            updateHeads($id, $updHeads);
            break;
        case 6:
            print("Id: ");
            $id = 4;
            deleteById($id);
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
