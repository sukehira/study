<?php
require_once 'config/env.php';
require_once 'lib/function.php';

if (!empty($_POST)) {
    updateRecruitment($_POST);
    header("Location: http://localhost:8080/index.php");
    exit();
}
if (!empty($_GET['id'])) {
    $recruitment = findRecruitment($_GET['id']);
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

    <title>編集</title>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-light navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Recruitment 編集</a>
</nav>


<div class="container">
    <form class="needs-validation" action="edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $recruitment['id']; ?>">
        <div class="form-row mb-4">
            <div class="col-md-6">
                <label for="lastName">名字</label>
                <input type="text" name="name_sei" value="<?php echo $recruitment['name_sei']; ?>" class="form-control"
                       id="lastName" placeholder="名字" required>
                <div class="invalid-feedback">
                    入力してください
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="firstName">名前</label>
                <input type="text" name="name_mei" value="<?php echo $recruitment['name_mei']; ?>" class="form-control"
                       id="firstName" placeholder="名前" required>
                <div class="invalid-feedback">
                    入力してください
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">メールアドレス</label>
            <div class="col-sm-10">
                <input type="email" name="email" value="<?php echo $recruitment['email']; ?>" class="form-control"
                       id="inputEmail" placeholder="メールアドレス" required>
                <div class="invalid-feedback">入力してください</div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <label for="inputAddress02">都道府県</label>
                <input type="text" name="prefecture" value="<?php echo $recruitment['prefecture']; ?>"
                       id="inputAddress02"
                       class="form-control" placeholder="東京都" required>
                <div class="invalid-feedback">入力してください</div>
            </div>
            <div class="col-md-6">
                <label for="inputAddress03">住所</label>
                <input type="text" name="address" value="<?php echo $recruitment['address']; ?>" class="form-control"
                       id="inputAddress03" required>
                <div class="invalid-feedback">入力してください</div>
            </div>
            <div class="col-md-3">
                <label for="inputAddress03">マンション</label>
                <input type="text" name="mansion" value="<?php echo $recruitment['mansion']; ?>" class="form-control"
                       id="inputAddress03" required>
                <div class="invalid-feedback">入力してください</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">電話番号</label>
            <div class="col-sm-2">
                <input type="tel" name="tel" value="<?php echo $recruitment['tel']; ?>" class="form-control"
                       id="inputEmail" placeholder="080-1234-5678" required>
                <div class="invalid-feedback">入力してください</div>
            </div>
        </div>
        経験PG言語
        <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="checkbox" <?php echo checkTheCheckBox($recruitment['experience_pg'], "C") ?>
                   name="experience_pg[]" value="C">
            <label class="form-check-label">C</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="checkbox" <?php echo checkTheCheckBox($recruitment['experience_pg'], "C++") ?>
                   name="experience_pg[]" value="C++">
            <label class="form-check-label">C++</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="checkbox" <?php echo checkTheCheckBox($recruitment['experience_pg'], "C#") ?>
                   name="experience_pg[]" value="C#">
            <label class="form-check-label">C#</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="checkbox" <?php echo checkTheCheckBox($recruitment['experience_pg'], "java") ?>
                   name="experience_pg[]" value="java">
            <label class="form-check-label">java</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="checkbox" <?php echo checkTheCheckBox($recruitment['experience_pg'], "python") ?>
                   name="experience_pg[]" value="python">
            <label class="form-check-label">python</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="checkbox" <?php echo checkTheCheckBox($recruitment['experience_pg'], "ruby") ?>
                   name="experience_pg[]" value="ruby">
            <label class="form-check-label">ruby</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="checkbox" <?php echo checkTheCheckBox($recruitment['experience_pg'], "php") ?>
                   name="experience_pg[]" value="php">
            <label class="form-check-label">php</label>
        </div>
        <br>
        経験DB言語
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="experience_db[]"
                   type="checkbox"
                   value="Oracel" <?php echo checkTheCheckBox($recruitment['experience_db'], "Oracel") ?>>
            <label class="form-check-label">Oracel</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="experience_db[]"
                   type="checkbox"
                   value="MS SQL server" <?php echo checkTheCheckBox($recruitment['experience_db'], "MS SQL server") ?>>
            <label class="form-check-label">MS SQL server</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="experience_db[]"
                   type="checkbox"
                   value="MySQL" <?php echo checkTheCheckBox($recruitment['experience_db'], "MySQL") ?>
            <label class="form-check-label">MySQL</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="experience_db[]"
                   type="checkbox"
                   value="PosgreSQL" <?php echo checkTheCheckBox($recruitment['experience_db'], "PosgreSQL") ?>
            <label class="form-check-label">PosgreSQL</label>
        </div>
        <br>
        画像<input name="img" type="file"><br>
        <input type="submit" value="更新">
    </form>
    <button class="btn btn-lg btn-primary btn-block btn-signin" onclick="location.href='./index.php'" type="submit">
        一覧に戻る
    </button>


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
