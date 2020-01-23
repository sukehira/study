<?php
require_once 'config/env.php';
require_once 'lib/function.php';

session_start();

$request = $_POST;
$nowPage = $_GET['page_id'];
$registeredID = $_SESSION['id'];



// ページネーションのための処理
$totalCounts = columnCountNumber();
$maxPage = maxPageCount($totalCounts);
$offSetNumber = decideOffSetNumber($nowPage, $maxPage);

// 求人一覧を取得する
$recruitmentLists = fetchRecruitmentList($request, $offSetNumber);
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

<!-- Navigation -->
<nav class="navbar navbar-light navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Recruitment 一覧</a>
</nav>
<div class="container">
    <a href="logout.php">ログアウト</a>
</div>
<!-- Page Content -->
<div class="container mt-5 p-lg-5 bg-light">

    <form class="needs-validation" action="index.php" method="post" novalidate>

        <!--氏名-->
        <div class="form-row mb-4">
            <div class="col-md-6">
                <label for="lastName">名字</label>
                <input type="text" name="name_sei" class="form-control" id="lastName" placeholder="名字" required>
                <div class="invalid-feedback">
                    入力してください
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="firstName">名前</label>
                <input type="text" name="name_mei" class="form-control" id="firstName" placeholder="名前" required>
                <div class="invalid-feedback">
                    入力してください
                </div>
            </div>
        </div>
        <!--/氏名-->

        <!--Eメール-->
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">メールアドレス</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="メールアドレス" required>
                <div class="invalid-feedback">入力してください</div>
            </div>
        </div>
        <!--/Eメール-->
        <!--都道府県-->
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">都道府県</label>
            <div class="col-sm-10">
                <input type="text" name="prefecture" class="form-control" id="inputEmail" placeholder="都道府県" required>
                <div class="invalid-feedback">入力してください</div>
            </div>
        </div>
        <!--/都道府県-->

        <!--性別-->
        <div class="form-group">
            <div class="row mb-4">
                <legend class="col-form-label col-sm-2">性別</legend>
                <div class="col-sm-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="gender" value="男" class="custom-control-input"
                               required>
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
        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">検索</button>
    </form>
    <button class="btn btn-lg btn-primary btn-block btn-signin" onclick="location.href='./index.php'" type="submit">
        条件クリア
    </button>
</div>

<div class="container">
    <nav aria-label>
        <ul class="pagination">
            <?php if ($totalCounts > 3): ?>
                <a href=index.php?page_id=1> << </a>
                <?php if ($page > 1) : ?>
                    <a href=index.php?page_id=<?php echo $page - 1 ;?> > 前へ </a>
                <?php endif; ?>
                <?php
                for ($i = 1; $i <= $maxPage; $i++) { // 最大ページ数分リンクを作成
                    if ($i == $page) { // 現在表示中のページ数の場合はリンクを貼らない
                        echo $page . '　';
                    } else {
                        echo '<a href=\'/index.php?page_id=' . $i . '\'>' . $i . '</a>' . '　';
                    }
                }
                ?>
                <?php if ($page < $maxPage) : ?>
                    <a href=index.php?page_id=<?php echo $page + 1 ;?> > 次へ </a>
                <?php endif; ?>
                <a href=index.php?page_id=<?php echo $maxPage ;?> > >> </a>
            <?php endif; ?>
        </ul>
    </nav>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col"><a href="index.php?order=id&sort=asc">ID</a></th>
            <th scope="col"><a href="index.php?sort=name">名前</a></th>
            <th scope="col"><a href="index.php?sort=mail">メールアドレス</a></th>
            <th scope="col">性別</th>
            <th scope="col"><a href="index.php?sort=prefecture">都道府県</a></th>
            <th scope="col">経験PG言語</th>
            <th scope="col">経験DB言語</th>
            <th scope="col">本人写真</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($recruitmentLists as $recruitmentList): ?>
            <tr>
                <td><?= h($recruitmentList['id']) ?></td>
                <td><?= h($recruitmentList['name_sei']) . $recruitmentList['name_mei'] ?></td>
                <td><?= h($recruitmentList['email']) ?></td>
                <td><?= h($recruitmentList['gender']) ?></td>
                <td><?= h($recruitmentList['prefecture']) ?></td>
                <td><?= h($recruitmentList['experience_pg']) ?></td>
                <td><?= h($recruitmentList['experience_db']) ?></td>
                <td><img src=<?php echo $recruitmentList['photo'] ?> alt="画像"></td>
                <?php if ($registeredID == $recruitmentList['id']) : ?>
                    <td><?php echo "<a href=edit.php?id=" . $recruitmentList["id"] . ">編集</a>"; ?></td>
                    <td><?php echo "<a href=destroy.php?id=" . $recruitmentList["id"] . ">削除</a>"; ?></td>
                <?php endif; ?>
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
