<?php
require 'connection.php';
$catId = $_GET['id'];

$selectQuery = "SELECT id FROM categories WHERE id='$catId'";
$result = mysqli_query($conn, $selectQuery);
if (mysqli_num_rows($result)>0) {
    $deleteQuery = "DELETE fROM categories WHERE id = '$catId'";
    if (mysqli_query($conn, $deleteQuery) === TRUE) {
        echo "Category Deleted Successfully.";
        header("Location: category-list.php");
    }
}else{
    echo "Category Doesnot found.";
}



?>