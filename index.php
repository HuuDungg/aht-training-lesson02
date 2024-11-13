<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký người dùng</title>
</head>

<body>
    <h2>Đăng ký người dùng</h2>
    <form action="" method="POST">
        <label for="username">Tên đăng nhập:</label><br>
        <input type="text" id="username" name="username"><br><br>

        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br><br>

        <label for="phone">password:</label><br>
        <input type="text" id="phone" name="phone"><br><br>

        <input type="submit" name="register" value="Đăng ký">
        <input type="submit" name="show" value="show json">
    </form>

    <?php
    if ($_POST["register"]) {
        $error = [];

        if (empty($_POST["username"])) {
            $error[] = "username must be not empty";
        }

        if (empty($_POST["email"])) {
            $error[] = "email must be not empty";
        }

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $error[] = "email is invalid";
        }

        if (empty($_POST["phone"])) {
            $error[] = "phone must be not empty";
        }

        if (strlen($_POST["phone"]) < 8) {
            $error[] = "phone must be more then 8 char";
        }

        if (empty($error)) {
            $myfile = fopen("account.json", "w");
            $data = json_encode(["username" => $_POST["username"], "email" => $_POST["email"], "phone" => $_POST["phone"]]);
            fwrite($myfile, $data);
            echo "register success";
        } else {
            foreach ($error as $e) {
                echo "<div>$e</div>";
            }
        }
    }

    if (isset($_POST["show"])) {
        if (file_exists("account.json")) {
            $myfile = file_get_contents("account.json");
            echo "show data: " . $myfile;
        } else {
            echo "File account.json không tồn tại.";
        }
    }
    ?>
</body>

</html>