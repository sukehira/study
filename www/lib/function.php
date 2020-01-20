<?php

require_once 'config/env.php';

/**
 * @return PDO
 */
function dbConnect(): PDO
{
    $db = DB_DBNAME;
    $host = DB_HOSTNAME;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;

    try {
        $db = new PDO("mysql:dbname=$db;host=$host;charset=utf8", $username, $password);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
        $e->getMessage();
        echo 'データベースに接続できません！アプリの設定を確認してください。';
        exit;
    }

    return $db;
}

/**
 * @param array $request
 * @param string $page
 * @return array
 */
function fetchRecruitmentList(array $request, string $page): array
{
    $db = dbConnect();

    $where = [];
    if (!empty($request['name_sei'])) {
        $where[] = "name_sei like '%{$request['name_sei']}%'";
    }
    if (!empty($request['name_mei'])) {
        $where[] = "name_mei like '%{$request['name_mei']}%'";
    }
    if (!empty($request['email'])) {
        $where[] = "email like '%{$request['email']}%'";
    }
    // 誕生日
    if (!empty($request['start_birthday']) && !empty($request['end_birthday'])) {
        $where[] = "birthday between '{$request['start_birthday']}' and '{$request['end_birthday']}'";
    } elseif (!empty($request['start_birthday'])) {
        $where[] = "birthday >= '{$request['start_birthday']}'";
    } elseif (!empty($request['end_birthday'])) {
        $where[] = "birthday <= '{$request['end_birthday']}'";
    }
    if (!empty($request['prefecture'])) {
        $where[] = "prefecture = '{$request['prefecture']}'";
    }
    if (!empty($request['gender'])) {
        $where[] = "gender = '{$request['gender']}'";
    }
    if (!empty($request['experience_pg'])) {
        foreach ($request['experience_pg'] as $item) {
            $where[] = "find_in_set('{$item}', experience_pg)";
        }
    }
    if (!empty($request['experience_db'])) {
        foreach ($request['experience_db'] as $item) {
            $where[] = "find_in_set('{$item}', experience_db)";
        }
    }
    if ($where) {
        $whereSql = implode(' AND ', $where);
        $sql = "select * from job_application where . {$whereSql} . limit :off, 3";
    } else {
        $sql = 'select * from job_application limit :off, 3';
    }

    $statement = $db->prepare($sql);
    $statement->bindValue(':off', $page);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @param string $request
 * @return array
 */
function findRecruitment(string $request): array
{
    $db = dbConnect();

    $sql = "select * from job_application where id = :id";
    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $request);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * @param array $request
 * @throws Exception
 */
function updateRecruitment(array $request)
{
    $db = dbConnect();

    $requestData = stringConversion($request);
    $requestData['photo'] = fileUpload();

    $sql = "UPDATE job_application
            SET
              name_sei = :name_sei,
              name_mei = :name_mei,
              email = :email,
              prefecture = :prefecture,
              address = :address,
              mansion = :mansion,
              tel = :tel,
              experience_pg = :experience_pg,
              experience_db = :experience_db,
              photo = :photo
            WHERE id = :id";

    $statement = $db->prepare($sql);
    $statement->execute($requestData);
}

/**
 * @param array $request
 * @return array
 */
function stringConversion(array $request): array
{
    $commaSeparated = [];
    foreach ($request as $key => $value) {
        if (is_array($value)) {
            $commaSeparated[$key] = implode(',', $value);
        } else {
            $commaSeparated[$key] = $value;
        }
    }

    return $commaSeparated;
}

/**
 * @param string $commaSeparated
 * @param string $target
 * @return string
 */
function checkTheCheckBox(string $commaSeparated, string $target): string
{
    $conversion = explode(',', $commaSeparated);
    if (in_array($target, $conversion)) {
        return "checked";
    } else {
        return "";
    }
}


/**
 * @param string $requestId
 */
function deleteRecruitment(string $requestId): void
{
    $db = dbConnect();
    $sql = "DELETE FROM job_application WHERE id = :id";

    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $requestId);
    $statement->execute();
}

/**
 * @param array $request
 * @throws ImagickException
 */
function storeRecruitment(array $request): void
{
    $db = dbConnect();
    $requestData = stringConversion($request);
    $requestData['photo'] = fileUpload();

    $sql = "INSERT INTO job_application (
                                name_sei, 
                                name_mei, 
                                email, 
                                passwd, 
                                birthday,
                                prefecture,
                                address,
                                mansion,
                                tel,
                                gender,
                                experience_pg,
                                experience_db,
                                photo
                                ) 
                             VALUES (
                                :name_sei, 
                                :name_mei, 
                                :email, 
                                :passwd, 
                                :birthday,
                                :prefecture,
                                :address,
                                :mansion,
                                :tel,
                                :gender,
                                :experience_pg,
                                :experience_db,
                                :photo
                                )";

    $statement = $db->prepare($sql);
    $statement->execute($requestData);
}

/**
 * @return string|void
 * @throws ImagickException
 */
function fileUpload()
{
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
        return;
    }

    $upFile = $_FILES['img'];
    $tmpName = $upFile['tmp_name'];

    if ($upFile['error'] > 0) {
        throw new Exception('ファイルアップロードに失敗しました。');
    }

    // ファイルタイプの確認
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $tmpName);

    $allowedTypes = [
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif'
    ];

    if (!in_array($mimeType, $allowedTypes)) {
        throw new Exception('許可されていないファイルタイプです。');
    }

    $fileName = sha1_file($tmpName);

    // 保存できるか確認
    $ext = array_search($mimeType, $allowedTypes);
    $destinationPath = sprintf('%s/%s.%s', 'images', $fileName, $ext);
    if (!move_uploaded_file($tmpName, $destinationPath)) {
        throw new Exception('ファイルの保存に失敗しました。');
    }

    // リサイズ処理
    $image = new Imagick($destinationPath);
    $image->thumbnailImage(100, 100);
    $image->writeImage($destinationPath);

    return $destinationPath;
}

/**
 * @param $string
 * @return string
 */
function h($string): string
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * @param $url
 */
function redirect($url)
{
    header('Location: ' . $url);
    exit();
}

/**
 * @return array
 */
function columnCountNumber(): array
{
    $db = dbConnect();
    $count = $db->query('select count(*) as count from job_application');
    return $count->fetch();
}

/**
 * @param $page
 * @param $maxPage
 * @return int
 */
function decideStartPage($page, $maxPage): int
{
    $startPage = ($page - 1) * 3;
    if (empty($startPage)) {
        $startPage = 1;
    }
    if ($startPage < 1) {
        $startPage = max($startPage, 1);
    }
    if ($startPage > $maxPage) {
        $startPage = min($startPage, $maxPage);
    }
    return $startPage;
}

/**
 * @param $totalCounts
 * @return string
 */
function maxPageCount($totalCounts): string
{
    return ceil($totalCounts['count'] / 3);
}


/**
 * @param $request
 * @return array
 */
function login($request): array
{
    $db = dbConnect();

    $sql = "SELECT * FROM job_application WHERE email = :email AND passwd = :passwd";
    $statement = $db->prepare($sql);

    $statement->bindValue(':email', $request['email']);
    $statement->bindValue(':passwd', $request['passwd']);

    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}



