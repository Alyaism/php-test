<?php
session_start();
include '../includes/conn.php';
if(isset($_GET['menuId'])){
    $menuId = $_GET['menuId'];
    $checkIngredient = "SELECT * FROM ingredient WHERE fkMenuId = '$menuId'";
    $resultCheckIngredient = $conn->query($checkIngredient);
    foreach ($resultCheckIngredient as $key => $data) {
        $ingredientId = $data['fkIngredientListId'];
        $findIngredientList = "SELECT * FROM ingredientList WHERE ingredientListId ='".$ingredientId."'";
        $resultFindIngredientList = $conn->query($findIngredientList)->fetch_assoc();
        if($resultFindIngredientList['total'] < $data['used']){
            echo "ไม่สามารถสั่งอาหารได้ เนื่องจากสินค้าไม่เพียงพอ";
            $_SESSION['stockNotEnough'] = "stockNotEnough";
            header("location: ../index.php?error=stockNotEnough");
            exit();
        }
    }

    foreach ($resultCheckIngredient as $key => $x) {
        $ingredientId = $x['fkIngredientListId'];
        $findIngredientList = "SELECT * FROM ingredientList WHERE ingredientListId ='".$ingredientId."'";
        $resultFindIngredientList = $conn->query($findIngredientList)->fetch_assoc();
        $total = $resultFindIngredientList['total'] - $x['used'];
        $updateIngredientList = "UPDATE ingredientList SET total = '$total' WHERE ingredientListId = '$ingredientId'";
        $conn->query($updateIngredientList);
    }
    $_SESSION['orderSuccess'] = "orderSuccess";
    header("location: ../index.php?success=orderSuccess");

}
