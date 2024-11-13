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

        <label for="password">Mật khẩu:</label><br>
        <input type="text" id="password" name="password"><br><br>

        <input type="submit" value="Đăng ký">
    </form>

    <?php
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

    if (empty($_POST["password"])) {
        $error[] = "password must be not empty";
    }

    if (strlen($_POST["password"]) < 8) {
        $error[] = "password must be more then 8 char";
    }

    if (empty($error)) {
        $myfile = fopen("account.json", "w");
        $data = json_encode(["username" => $_POST["username"], "email" => $_POST["email"], "password" => $_POST["password"]]);
        fwrite($myfile, $data);
    } else {
        foreach ($error as $e) {
            echo "<div>$e</div>";
        }
    }




    ?>
</body>

</html>