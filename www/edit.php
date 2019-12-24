<?php
require_once 'config/env.php';
require_once 'lib/function.php';


$where = [];
if (!empty($request['name_sei'])) {
    $where[] = "name_sei = {$request['name_sei']}";
}
if (!empty($request['name_mei'])) {
    $where[] = "name_mei = {$request['name_mei']}";
}
if (!empty($request['email'])) {
    $where[] = "email = {$request['email']}";
}
if (!empty($request['password'])) {
    $where[] = "passwd = {$request['password']}";
}
if (!empty($request['prefecture'])) {
    $where[] = "prefecture = {$request['prefecture']}";
}
if (!empty($request['address'])) {
    $where[] = "address = {$request['address']}";
}
if (!empty($request['mansion'])) {
    $where[] = "mansion = {$request['mansion']}";
}
if (!empty($request['tel'])) {
    $where[] = "tel = {$request['tel']}";
}
if (!empty($request['self_pr'])) {
    $where[] = "self_pr = {$request['self_pr']}";
}

$whereSql = implode("," , $where);

$sql = "update job_application set {$whereSql} where id = {$request}";


$stm = $db->prepare($sql);
$stm->execute();
$stm->fetchAll(PDO::FETCH_ASSOC);




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

<div class="container">
    <?php echo $requestId;?>
    <form action="edit.php" method="post">

        <input type="hidden" name="id" value="<?php echo $requestId ;?>">
        お名前 性<input type="text" name="name_sei">名<input type="text" name="name_mei"><br>
        メールアドレス <input type="email" name="email"><br>
        パスワード <input type="password" name="password"><br>
        パスワード（確認） <input type="password" name="password"><br>
        生年月日 <input type="number">年<input type="number">月<input type="number">日 <br>
        郵便番号 <input type="text"><input type="text"><br>
        都道府県 <input type="text"><br>
        住所 <input type="text"><br>
        マンション <input type="text"><br>
        TEL <input type="tel"><br>
        性別
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label">男</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label">女</label>
        </div>
        <br>

        経験PG言語
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label">C</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label">C++</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
            <label class="form-check-label">C#</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4">
            <label class="form-check-label">java</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5">
            <label class="form-check-label">python</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio6" value="option6">
            <label class="form-check-label">ruby</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio7" value="option7">
            <label class="form-check-label">php</label>
        </div>
        <br>

        経験DB言語
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
            <label class="form-check-label">Oracel</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
            <label class="form-check-label">MS SQL server</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
            <label class="form-check-label">MySQL</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
            <label class="form-check-label">PosgreSQL</label>
        </div>
        <br>

        自己PR <input type="text"><br>
        本人写真 <input type="text"><br>
        <button onclick='location.href'='edit.php?id=1 type='submit'>保存</button>
    </form>
    <button class="btn btn-lg btn-primary btn-block btn-signin" onclick="location.href='./index.php'" type="submit">一覧に戻る</button>
</div>

<div class="container">

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
