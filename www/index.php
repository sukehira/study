<?php

require_once 'config/env.php';


$db = DB_DBNAME;
$host = DB_HOSTNAME;
$username = DB_USERNAME;
$password = DB_PASSWORD;

$params = $_POST;

try {
    $conn = new PDO("mysql:dbname=$db;host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'データベースに接続できません！アプリの設定を確認してください。';
    exit;
}

$where = [];
if (!empty($params['name_sei'])) {
    $where[] = "name_sei like '%{$params['name_sei']}%'";
}
if (!empty($params['email'])) {
    $where[] = "email like '%{$params['email']}%'";
}
// 誕生日
if (!empty($params['start_birthday']) && !empty($params['end_birthday'])) {
    $where[] = "birthday between '{$params['start_birthday']}' and '{$params['end_birthday']}'";
} elseif (!empty($params['start_birthday'])) {
    $where[] = "birthday >= '{$params['start_birthday']}'";
} elseif (!empty($params['end_birthday'])) {
    $where[] = "birthday <= '{$params['end_birthday']}'";
}
if (!empty($params['prefecture'])) {
    $where[] = "prefecture = '{$params['prefecture']}'";
}
if (!empty($params['gender'])) {
    $where[] = "gender = '{$params['gender']}'";
}
if (!empty($params['experience_pg'])) {
    $experiencePgs = implode("','", $params['experience_pg']);
    $where[] = "experience_pg in ('{$experiencePgs}')";
}

if ($where) {
    $whereSql = implode(' AND ', $where);
    $sql = 'select * from job_application where ' . $whereSql;
} else {
    $sql = 'select * from job_application';
}

$stm = $conn->prepare($sql);
$stm->execute();
$results = $stm->fetchAll(PDO::FETCH_ASSOC);

$totalCounts = count($results);
$maxPage = ceil($totalCounts / 3);

if (!isset($_GET['page_id'])) { // $_GET['page_id'] はURLに渡された現在のページ数
    $now = 1; // 設定されてない場合は1ページ目にする
} else {
    $now = $_GET['page_id'];
}
$back = $now - 1;
$move = $now + 1;

$startNumber = ($now - 1) * 3; // 配列の何番目から取得すればよいか
$resultsData = array_slice($results, $startNumber, 3, true);

?>

<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>求人応募一覧</title>
</head>
<body>

<div class="container">
    <form action="index.php" method="post">
        名前 <input type="text" name="name_sei"><br>
        メールアドレス <input type="text" name="email"><br>
        生年月日 <input type="text" name="start_birthday"> ~ <input type="text" name="end_birthday"><br>
        都道府県 <input type="text" name="prefecture"><br>
        性別
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" value="男">
            <label class="form-check-label">男</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" value="女">
            <label class="form-check-label">女</label>
        </div>
        <br>
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
        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">検索</button>
    </form>
</div>

<div class="container">
    <nav aria-label>
        <ul class="pagination">
            <?php if ($totalCounts > 3): ?>
                <?php echo '<a href=\'/index.php?page_id= 1 \'> << </a>' . '　'; ?>
                <?php echo '<a href=\'/index.php?page_id=' . $back . '\'> < </a>' . '　'; ?>

                <?php
                for ($i = 1; $i <= $maxPage; $i++) { // 最大ページ数分リンクを作成
                    if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
                        echo $now . '　';
                    } else {
                        echo '<a href=\'/index.php?page_id=' . $i . '\'>' . $i . '</a>' . '　';
                    }
                }
                ?>

                <?php echo '<a href=\'/index.php?page_id=' . $move . '\'> > </a>' . '　'; ?>
                <?php echo '<a href=\'/index.php?page_id=' . $maxPage . '\'> >> </a>' . '　'; ?>
            <?php endif;?>
        </ul>
    </nav>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col"><a href="index.php?sort=id">ID</a></th>
            <th scope="col"><a href="index.php?sort=name">名前</a></th>
            <th scope="col"><a href="index.php?sort=mail">メールアドレス</a></th>
            <th scope="col">性別</th>
            <th scope="col"><a href="index.php?sort=prefecture">都道府県</a></th>
            <th scope="col">経験PG言語</th>
            <th scope="col">本人写真</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($resultsData as $data): ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['name_sei'] . $data['name_mei']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['gender']; ?></td>
                <td><?php echo $data['prefecture']; ?></td>
                <td><?php echo $data['experience_pg']; ?></td>
                <td><?php echo $data['photo']; ?></td>
                <td><a href="edit.php">編集</a></td>
                <td><a href="destroy.php">削除</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

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
