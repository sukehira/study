<?php

// TODO
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

    <title>メニュー</title>
</head>
<body>
<div class="position-absolute h-100 w-100 m-0 d-flex align-items-center justify-content-center">
    <div class="container" class="mx-auto">
        <div class="card card-container">
            <form action="menu.php" method="post">
                <button type="button" class="btn btn-primary btn-block" onclick="location.href='index.php'">一覧</button>
                <button type="button" class="btn btn-primary btn-block" onclick="location.href='store.php'">登録</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
