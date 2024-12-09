<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
    header("Location:login.php");
    exit();
}

// اتصال به دیتابیس
$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

// بررسی ورود ادمین
if (!isset($_SESSION['user']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>admin-dashboard</title>
    <link rel="stylesheet" href="./admin-dashboard.css" />
</head>

<body dir="rtl">
    <div class="sidebar">
        <a style="display: flex; align-items: center; direction: ltr; column-gap: 10px; padding-left:60px" href="./MainPage.php">
            <h4>صفحه اصلی</h4>
            <img src="./img/1.png" width="20px" height="20px" />
        </a>
        <a style="display: flex; align-items: center; direction: ltr; padding-left:45px" href="./product.php">
            <h4>افزودن محصول</h4>
            <img src="./img/2.jpg" width="30px" height="30px" />
        </a>
        <a style="display: flex;  align-items: center; direction: ltr; column-gap: 10px; padding-left:35px" href="./ManageOrders.php">
            <h4>مدیریت سفارشات</h4>
            <img src="./img/7.png" width="20px" height="20px" />
        </a>
        <a style="display: flex; align-items: center; direction: ltr; column-gap: 10px; padding-left:95px" href="./logout-validation.php">
            <h4>خروج</h4>
            <img src="./img/3.png" width="20px" height="20px" />
        </a>
    </div>
    <div class="content">
        <table class="product-table">
            <tr>
                <th>تصویر</th>
                <th>نام محصول</th>
                <th>توضیحات</th>
                <th>جنس</th>
                <th>سایز</th>
                <th>رنگ</th>
                <th>قد</th>
                <th>تعداد</th>
                <th>قیمت</th>
                <th>عملیات</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='uploads/" . $row['productimage'] .  "' alt='Product Image' ></td>";
                    echo "<td><h3 class='product-name'>" . $row['productname'] . "</h3></td>";
                    echo "<td><p class='product-description'>" . $row['productdescription'] . "</p></td>";
                    echo "<td><p class='product-material'>" . $row['productmaterial'] . "</p></td>";
                    echo "<td><p class='product-size'>" . $row['productsize'] . "</p></td>";
                    echo "<td><p class='product-color'>" . $row['productcolor'] . "</p></td>";
                    echo "<td><p class='product-height'>" . $row['productheight'] . "</p></td>";
                    echo "<td><p class='product-stock'>" . $row['productstock'] . "</p></td>";
                    echo "<td><h2 class='product-price'>" . number_format($row['productprice']) . " تومان </h2></td>";
                    echo "<td>
                            <a href='edit-product.php?id=" . $row['id'] . "' class='btn-edit'>ویرایش</a>
                            <a href='delete-product.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"آیا مطمئنید؟\")'>حذف</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>هیچ محصولی یافت نشد</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>