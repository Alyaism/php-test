<?php
include '../includes/conn.php';

if(isset($_POST['ingredientListId'])){
    $ingredientListId = $_POST['ingredientListId'];
    $findIngredientList = "SELECT * FROM ingredientList WHERE ingredientListId = '$ingredientListId'";
    $resultFindIngredientList = $conn->query($findIngredientList)->fetch_assoc();
    $total = $resultFindIngredientList['total'];
    echo $total;
}
