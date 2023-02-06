<?php
include 'includes/conn.php';
include 'includes/head.php';

$findMenu = "SELECT * FROM menu";
$result = $conn->query($findMenu);
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
            <div class="col-sm-3"></div>
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <h4>รายการอาหาร</h4>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="addStock.php" class="btn btn-success">เพิ่มวัตถุดิบ</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='card mb-3'>";
                                echo "<div class='card-body'>";
                                echo "<h5 class='card-title'>" . $row['menuName'] . "</h5>";
                                echo "<a href='systems/order.php?menuId=" . $row['menuId'] . "' class='btn btn-primary'>สั่งอาหาร</a>";
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
            <div class="col-sm-3"></div>
        </div>

    </div>

</body>

</html>


<?php
if (isset($_SESSION['stockNotEnough'])) { ?>

    <script>
        Swal.fire({
            icon: 'error',
            title: 'วัตถุดิบไม่เพียงพอ..',
            html: `Trick: เพิ่มวัตถุดิบให้เพียงพอก่อนสั่งอาหาร`,
            timer: 5000,
            timerProgressBar: true,
            customClass: 'swal-wide',

        }).then((result) => {
            <?php
            unset($_SESSION['stockNotEnough']);
            ?>
        })
    </script>
<?php
} ?>
<?php
if (isset($_SESSION['orderSuccess'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'สั่งอาหารสำเร็จ..',
            html: `Trick: สั่งอาหารใหม่ได้เลย`,
            timer: 5000,
            timerProgressBar: true,
            customClass: 'swal-wide',

        }).then((result) => {
            <?php
            unset($_SESSION['orderSuccess']);
            ?>
        })
    </script>
<?php
} ?>