<?php
require_once 'config/env.php';
require_once 'lib/function.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['$password'];




$db = dbConnect();

$sql = "select * from job_application where email = :email";
$statement = $db->prepare($sql);
$statement->bindValue(':email', $email);
$statement->execute();
$registeredUser =  $statement->fetch(PDO::FETCH_ASSOC);

if ($registeredUser['email'] == $email) {
    $msg = '同じメールアドレスが存在します。';
    $link = '<a href="signup.php">戻る</a>';
} else {
    $sql = "select * from job_application where email = :email";
    $statement = $db->prepare($sql);
    $statement->bindValue(':email', $email);
    $statement->execute();
}




?>

<!doctype html>
<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>新規登録</title>
</head>
<body>
<div class="position-absolute h-100 w-100 m-0 d-flex align-items-center justify-content-center">
    <div class="card card-container">
        <form class="form-signin" action="signup.php" method="post">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="name" class="form-control" placeholder="名前" name="name" required autofocus>
            <input type="email" class="form-control" placeholder="メール" name="email" required autofocus>
            <input type="password" class="form-control" placeholder="パスワード" name="passwd" required>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">新規登録</button>
        </form>
        <a href="ogin.php">すでに登録済みな方はこちら</a>
    </div>
</div>
</body>
</html>
