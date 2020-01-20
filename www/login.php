<?php
require_once 'config/env.php';
require_once 'lib/function.php';

session_start();


$request = filter_input_array(INPUT_POST, $_POST);

$errors = [];
if($_SERVER["REQUEST_METHOD"] = "POST") {
    // postされていたらの処理
    if ($request['email'] && $request['passwd']) {
        $registeredUser = login($request);
    }
    if (empty($request['email'])) {
        $errors[] = 'メールは必須です';
    }
    if (empty($request['passwd'])) {
        $errors[] = 'パスワードは必須です';
    }
    if ($registeredUser) {
        $_SESSION['id'] = $registeredUser['id'];
        $_SESSION['password'] = $registeredUser['name'];
        redirect('index.php');
    } else {
        $errors[] = 'メールアドレスかパスワードが正しくありません';
    }
}



//postがなかったら、エラーにつめない


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

    <title>ログインページ</title>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-light navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Recruitment 一覧</a>
</nav>
<div class="position-absolute h-100 w-100 m-0 d-flex align-items-center justify-content-center">
    <div class="card card-container">
        <form class="form-signin" action="login.php" method="post">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" class="form-control" placeholder="メール" name="email">
            <input type="password" class="form-control" placeholder="パスワード" name="passwd">
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">ログイン</button>
        </form>
    </div>
    <ul>
        <li>
            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <td><?= h($error) ?></td>
                <?php endforeach; ?>
            <?php endif; ?>
        </li>
    </ul>

    <a href="store.php">新規登録はこちら</a>
</div>
</body>
</html>
