<?php
require_once 'config/env.php';
require_once 'lib/function.php';

if (!empty($_POST)) {
    storeRecruitment($_POST);
    header("Location: http://localhost:8080/index.php");
    exit;
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

<!-- Navigation -->
<nav class="navbar navbar-light navbar-dark bg-dark">
    <a class="navbar-brand" href="./index.php">Recruitment 登録</a>
</nav>

<!-- Page Content -->
<div class="container mt-5 p-lg-5 bg-light">

    <form class="needs-validation" action="store.php" method="post" novalidate>

        お名前
        <div class="form-row mb-4">
            <div class="col-md-5">
                <input type="text" name="name_sei" class="form-control" placeholder="名字">
            </div>
            <div class="col-md-5">
                <input type="text" name="name_mei" class="form-control" placeholder="名前">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">メールアドレス</label>
            <div class="col-sm-5">
                <input type="email" name="email" class="form-control" placeholder="メールアドレス">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">パスワード</label>
            <div class="col-sm-3">
                <input type="password" name="passwd" class="form-control">
            </div>
        </div>
<!--        <div class="form-group row mb-4">-->
<!--            <label for="inputEmail" class="col-sm-2 col-form-label">パスワード 確認</label>-->
<!--            <div class="col-sm-3">-->
<!--                <input type="password" name="passwd" class="form-control">-->
<!--            </div>-->
<!--        </div>-->
        生年月日
        <div class="form-row">
            <div class="col-md-3 mb-4">
                <input type="text" name="birthday"
                       class="form-control">
            </div>
<!--            年-->
<!--            <div class="col-md-3">-->
<!--                <input type="text" name="address" class="form-control"-->
<!--                >-->
<!--            </div>-->
<!--            月-->
<!--            <div class="col-md-3">-->
<!--                <input type="text" name="mansion" class="form-control"-->
<!--                >-->
<!--            </div>-->
<!--            日-->
        </div>

        <!--/氏名-->
        <div class="form-row">
            <div class="col-md-3 mb-4">
                <label for="inputAddress02">都道府県</label>
                <input type="text" name="prefecture"
                       class="form-control" placeholder="東京都">
            </div>
            <div class="col-md-6">
                <label for="inputAddress03">住所</label>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="inputAddress03">マンション</label>
                <input type="text" name="mansion" class="form-control">
            </div>
        </div>
<!--        <div class="col-md-3">-->
<!--            <label for="inputAddress03">マンション</label>-->
<!--            <input type="text" name="mansion" class="form-control">-->
<!--        </div>-->
        電話番号
        <div class="form-row">
            <div class="col-md-1 mb-4">
                <input type="text" name="tel"
                       class="form-control">
            </div>
<!--            --->
<!--            <div class="col-md-1">-->
<!--                <input type="text" name="tel" class="form-control"-->
<!--                >-->
<!--            </div>-->
<!--            --->
<!--            <div class="col-md-1">-->
<!--                <input type="text" name="tel" class="form-control"-->
<!--                >-->
<!--            </div>-->
        </div>

        <!--性別-->
        <div class="form-group">
            <div class="row mb-4">
                <legend class="col-form-label col-sm-2">性別</legend>
                <div class="col-sm-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="gender" value="男" class="custom-control-input"
                               >
                        <label class="custom-control-label" for="customRadioInline1">男</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="gender" value="女"
                               class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2">女</label>
                    </div>
                </div>
            </div>
        </div>
        <!--/性別-->

        経験PG言語
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="experience_pg[]" value="C">
            <label class="form-check-label">C</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="experience_pg[]" value="C++">
            <label class="form-check-label">C++</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="experience_pg[]" value="C#">
            <label class="form-check-label">C#</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="experience_pg[]" value="java">
            <label class="form-check-label">java</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="experience_pg[]" value="python">
            <label class="form-check-label">python</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="experience_pg[]" value="ruby">
            <label class="form-check-label">ruby</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="experience_pg[]" value="php">
            <label class="form-check-label">php</label>
        </div>
        <br>
        経験DB言語
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="experience_db[]"
                   type="checkbox" value="Oracel">
            <label class="form-check-label">Oracel</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="experience_db[]"
                   type="checkbox" value="MS SQL server">
            <label class="form-check-label">MS SQL server</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="experience_db[]"
                   type="checkbox" value="MySQL">
            <label class="form-check-label">MySQL</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="experience_db[]"
                   type="checkbox" value="PosgreSQL">
            <label class="form-check-label">PosgreSQL</label>
        </div>
        <br>
<!--        <div class="form-group" class="row mb-4">-->
<!--            <label for="message">メッセージ</label>-->
<!--            <textarea name="message" rows="6" cols="80" class="form-control"></textarea>-->
<!--        </div>-->
<!--        <span class="btn btn-primary">-->
<!--            <input type="file">-->
<!--        </span>-->

        <input type="submit" value="確認">

    </form>
    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" onclick="location.href='./store.php'">
        クリア
    </button>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>
