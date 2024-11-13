<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
</head>

<body>
    <h1>Quản lý Danh sách Sản phẩm</h1>

    <form action="" method="POST">
        <label for="name">Tên sản phẩm:</label><br>
        <input type="text" id="name" name="name"><br><br>

        <label for="price">Giá sản phẩm:</label><br>
        <input type="text" id="price" name="price"><br><br>

        <label for="quantity">Số lượng:</label><br>
        <input type="text" id="quantity" name="quantity"><br><br>

        <input type="submit" name="add_product" value="Thêm Sản phẩm">
        <input type="submit" name="display_products" value="Hiển thị Sản phẩm">
        <input type="submit" name="search_product" value="Tìm kiếm Sản phẩm">
        <input type="submit" name="sort_products" value="Sắp xếp Theo Tên">
    </form>

    <br>

    <form action="" method="POST">
        <label for="keyword">Từ khóa tìm kiếm:</label><br>
        <input type="text" id="keyword" name="keyword"><br><br>
        <input type="submit" name="search_product" value="Tìm kiếm">
    </form>

    <br>

    <?php
    session_start(); // Dùng session để lưu danh sách sản phẩm

    // Khởi tạo mảng sản phẩm nếu chưa có
    if (!isset($_SESSION['products'])) {
        $_SESSION['products'] = [];
    }

    // Hàm thêm sản phẩm
    function addProduct($name, $price, $quantity)
    {
        if (!empty($name) && is_numeric($price) && is_numeric($quantity)) {
            $product = ['name' => $name, 'price' => $price, 'quantity' => $quantity];
            $_SESSION['products'][] = $product;
            echo "<p>Sản phẩm đã được thêm thành công!</p>";
        } else {
            echo "<p>Vui lòng nhập đầy đủ và chính xác thông tin sản phẩm!</p>";
        }
    }

    // Hàm hiển thị danh sách sản phẩm
    function displayProducts($products)
    {
        if (empty($products)) {
            echo "<p>Không có sản phẩm nào trong danh sách.</p>";
        } else {
            echo "<table border='1'>
                    <tr>
                        <th>Tên Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                    </tr>";
            foreach ($products as $product) {
                printf(
                    "<tr><td>%s</td><td>%s</td><td>%s</td></tr>",
                    $product['name'],
                    $product['price'],
                    $product['quantity']
                );
            }
            echo "</table>";
        }
    }

    // Hàm tìm kiếm sản phẩm theo từ khóa
    function searchProduct($products, $keyword)
    {
        $found = [];
        foreach ($products as $product) {
            if (strpos(strtolower($product['name']), strtolower($keyword)) !== false) {
                $found[] = $product;
            }
        }
        return $found;
    }

    // Hàm sắp xếp sản phẩm theo tên
    function sortProductsByName(&$products)
    {
        usort($products, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
    }

    // Xử lý các hành động từ form
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        addProduct($name, $price, $quantity);
    }

    if (isset($_POST['display_products'])) {
        displayProducts($_SESSION['products']);
    }

    if (isset($_POST['search_product'])) {
        $keyword = $_POST['keyword'];
        $found_products = searchProduct($_SESSION['products'], $keyword);
        displayProducts($found_products);
    }

    if (isset($_POST['sort_products'])) {
        sortProductsByName($_SESSION['products']);
        displayProducts($_SESSION['products']);
    }
    ?>
</body>

</html>