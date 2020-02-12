<?php
require "includes/includes.php";

switch (intval($_POST['type'])){
    case 1:
        $table_name = "products_rating";
        break;
    case 2:
        $table_name = "services_rating";
        break;
    default :
        exit;


}

//$myfile = fopen("debug.txt", "w") or die("Unable to open file!");

//fwrite($myfile, $table_name);


if (  $db->getRow("SELECT * FROM {$table_name} 
WHERE product_id = {$_POST['product_id']} AND user_id = {$auth->getId()}")  ){
    $db->update($table_name, [
        "rating" => $_POST['rating'],
    ],"product_id = {$_POST['product_id']} AND user_id = {$auth->getId()}");

}else {
    $db->insert($table_name, [
        "rating" => $_POST['rating'],
        "product_id" => $_POST['product_id'],
        "user_id" => $auth->getId(),
    ]);
}

//fwrite($myfile, $db->last_error());
