<?php
include 'includes/conn.php';
include 'includes/head.php';
//join table
$findMenu = "SELECT * FROM menu INNER JOIN ingredient ON menu.menuId = ingredient.fkMenuId  INNER JOIN ingredientList ON ingredient.fkIngredientListId = ingredientList.ingredientListId";
$result = $conn->query($findMenu);
$arr = array();
while ($row = $result->fetch_assoc()) {
    $arr[] = $row;
}
$resultArr = array();
if (isset($arr)) {

    foreach ($arr as $element) {
        $resultArr[$element['menuId']][] = $element;
    }
    // echo "<pre>";
    // print_r($resultArr);
    // echo "</pre>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-2"></div>
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <h4>รายละเอียดวัตถุดิบของอาหาร</h4>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="addStock.php" class="btn btn-success">เพิ่มวัตถุดิบ</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($result->num_rows > 0) {
                            foreach ($resultArr as $key => $value) {
                                echo "<div class='card mb-3'>";
                                echo "<div class='card-body'>";
                                echo "<b><h5 class='card-title'>" . $value[0]['menuName'] . "</h5></b>";
                                echo "<p class='card-text text-left'>";
                                foreach ($value as $key => $value) {
                                    echo $value['ingredientListName'] . " " . $value['used'] . "<br>";
                                }
                                echo "</p>";
                                echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "ไม่พบข้อมูล";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>

    </div>

</body>

</html>