<?php
include 'includes/conn.php';
include 'includes/head.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <h4>เพิ่มวัตถุดิบ</h4>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="index.php" class="btn btn-success">สั่งอาหาร</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- dropdown  -->
                        <form action="systems/addIngredient.php" method="post">
                            <select name="ingredientListId" id="ingredientListId" class="form-control form-control-lg">
                                <option value="0">เลือกวัตถุดิบ</option>
                                <?php

                                $findIngredientList = "SELECT * FROM ingredientList";
                                $result = $conn->query($findIngredientList);
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['ingredientListId'] . "'>" . $row['ingredientListName'] . "</option>";
                                }
                                ?>
                            </select>
                            <div class="result mt-2"></div>
                            <input required type="number" name="amount" class="form-control form-control-lg mt-3" placeholder="จำนวน">
                            <button type="submit" name="addIngredient" class="btn btn-primary btn-lg btn-block mt-3">เพิ่มวัตถุดิบ</button>
                        </form>
                        <div class="text-center mt-2 ">
                            <a class="" href="history.php">ดูประวัติการเพิ่มวัตถุดิบ</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-sm-3">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</body>

</html>
<script>
    const selectElement = document.querySelector('#ingredientListId');
    // console.log(selectElement);
    // selectElement.addEventListener('change', (event) => {
    //     const result = document.querySelector('.result');
    //     result.textContent = `You like ${event.target.value}`;
    //     console.log(event.target.value);
    // });
    selectElement.addEventListener('change', updateValue);

    function updateValue(e) {
        var ingredientListId = e.target.value;
        var result = document.querySelector('.result');
        if (ingredientListId == 0) {
            result.textContent = ``;
        } else {
            $.ajax({
                url: "systems/checkIngredient.php",
                method: "POST",
                data: {
                    ingredientListId: ingredientListId
                },
                success: function(data) {
                    if (data) {
                        console.log(data);
                        result.textContent = 'ตอนนี้จำนวนวัตถุดิบคงเหลือ ' + data;
                    } else {
                        result.textContent = ``;
                    }
                }
            });
        }
    }
</script>
<?php
if (isset($_SESSION['addIngredientSuccess'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'เพิ่มวัตถุดิบสำเร็จ..',
            html: `Trick: คลิกที่ปุ่ม <b>สั่งอาหาร</b> เพื่อสั่งอาหาร`,
            timer: 5000,
            timerProgressBar: true,
            customClass: 'swal-wide',

        }).then((result) => {
            <?php
            unset($_SESSION['addIngredientSuccess']);
            ?>
        })
    </script>
<?php
} ?>
<?php
if (isset($_SESSION['addIngredientError'])) { ?>

    <script>
        Swal.fire({
            icon: 'error',
            title: 'กรุณาเลือกวัตถุดิบ..',
            html: `Trick: วัตถุดิบหรือจำนวนไม่ควรเป็นค่าว่าง`,
            timer: 5000,
            timerProgressBar: true,
            customClass: 'swal-wide',

        }).then((result) => {
            <?php
            unset($_SESSION['addIngredientError']);
            ?>
        })
    </script>
<?php
} ?>