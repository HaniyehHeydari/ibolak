<?php
session_start();

$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
  die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./MainPage.css" />
  <title>ibolak</title>
</head>

<body>

  <?php include('Header.php') ?>

  <nav class="Navbar">
    <div>
      <a href="./MainPage.php">
        <p>صفحه اصلی</p>
      </a>
    </div>
    <div>
      <a href="#">
        <p>زنانه</p>
        <img src="https://ibolak.com/assets/icons/arrow-down.svg" />
      </a>
    </div>
    <div>
      <a href="#">
        <p>مردانه</p>
        <img src="https://ibolak.com/assets/icons/arrow-down.svg" />
      </a>
    </div>
    <div>
      <a href="#">
        <p>بچگانه</p>
        <img src="https://ibolak.com/assets/icons/arrow-down.svg" />
      </a>
    </div>
    <div>
      <a href="#">
        <p>کیف</p>
      </a>
    </div>
    <div class="Hat-Shawl-Scarf">
      <a href="#">
        <p>کلاه/شال/روسری</p>
        <img src="https://ibolak.com/assets/icons/arrow-down.svg" />
      </a>
    </div>
    <div>
      <a href="./logout-validation.php">
        <p>خروج</p>
      </a>
    </div>
    </div>
  </nav>
  </div>

  <!-- Main -->
  <main>
    <div class="carousel">
      <div class="carousel-slide active">
        <img src="./img/Label-1.jpg">
      </div>
      <div class="carousel-slide">
        <img src="./img/Label-2.jpg">
      </div>
      <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
      <button class="next" onclick="moveSlide(1)">&#10095;</button>
    </div>
    <div class="Row">
      <div class="Row-Top">
        <div class="Row-Top-One">
          <img src="https://ibolak.com/storage/image/2024/7/1721816527-8TBF2MYdTQlotWyM.webp" width="100%"
            style="border-radius: 16px;">
        </div>
        <div class="Row-Top-Two">
          <img src="https://ibolak.com/storage/image/2024/7/1721731387-3eLaOlzuxAPhTNYd.webp" width="100%"
            style="border-radius: 16px;">
        </div>
        <div class="Row-Top-Three">
          <img src="https://ibolak.com/storage/image/2024/7/1721731387-7hucXpvrzgNGqXPj.webp" width="100%"
            style="border-radius: 16px;">
        </div>
        <div class="Row-Top-Four">
          <img src="https://ibolak.com/storage/image/2024/7/1721731387-1OVhZaKqR0b4WYqF.webp" width="100%"
            style="border-radius: 16px;">
        </div>
      </div>
      <div class="Row-Down">
        <div class="Row-Top-One">
          <img src="https://ibolak.com/storage/image/2024/9/1725949731-3BuGTMgqiKL85LRp.webp" width="100%"
            style="border-radius: 16px;">
        </div>
        <div class="Row-Top-Two">
          <img src="https://ibolak.com/storage/image/2024/9/1725952416-tLIvWHRaNGdeHmmq.webp" width="100%"
            style="border-radius: 16px;">
        </div>
        <div class="Row-Top-Three">
          <img src="https://ibolak.com/storage/image/2024/9/1725949731-VY1E0CpY8MXXOcgL.webp" width="100%"
            style="border-radius: 16px;">
        </div>
        <div class="Row-Top-Four">
          <img src="https://ibolak.com/storage/image/2024/9/1725952416-0XVJCmDlrT3AP8L5.webp" width="100%"
            style="border-radius: 16px;">
        </div>
      </div>
    </div>
    <div class="hi">
      <h2 dir="rtl" style="color: #FFFFFF;">جدیدترین محصولات</h2>
      <div class="product-grid">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<div class='product-card'>";
            echo "<a href='detailes-product.php?id=" . $row['id'] . "'>";
            echo "<img src='uploads/" . $row['productimage'] . "' alt='" . $row['productname'] . "' class='product-image'>";
            echo "</a>";
            echo "<h3 class='product-name'>" . $row['productname'] . "</h3>";
            echo "<p class='product-description'>" . $row['productdescription'] . "</p>";
            echo "<h2 class='product-price'>" . number_format($row['productprice']) . " تومان</h2>";
            echo "</div>";
          }
        } else {
          echo "<p>هیچ محصولی یافت نشد</p>";
        }
        ?>
      </div>
    </div>
  </main>

  <?php include('Footer.php') ?>

  <script src="./MainPage.js"></script>
</body>

</html>