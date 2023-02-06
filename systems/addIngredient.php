<?php
session_start();
include '../includes/conn.php';
//add history and update ingredient
if(isset($_POST['addIngredient'])){
    if($_POST['ingredientListId'] == 0 || $_POST['amount'] <= 0){
        $_SESSION['addIngredientError'] = "addIngredientError";
        header("location: ../addStock.php?error=addIngredientError");
        exit();
    }

    $ingredientListId = $_POST['ingredientListId'];
    $amount = $_POST['amount'];
    $findIngredientList = "SELECT * FROM ingredientList WHERE ingredientListId = '$ingredientListId'";
    $resultFindIngredientList = $conn->query($findIngredientList)->fetch_assoc();
    $total = $resultFindIngredientList['total'] + $amount;
    $updateIngredientList = "UPDATE ingredientList SET total = '$total' WHERE ingredientListId = '$ingredientListId'";
    $conn->query($updateIngredientList);

    $insertToHistory = "INSERT INTO history (fkIngredientListId, amount, billDate) VALUES ('$ingredientListId', '$amount', NOW())";
    $conn->query($insertToHistory);
    $_SESSION['addIngredientSuccess'] = "addIngredientSuccess";
    header("location: ../addStock.php?success=addIngredientSuccess");

}
