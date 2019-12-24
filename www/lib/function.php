<?php

require_once 'config/env.php';

function dbConnect() :PDO
{
    $db = DB_DBNAME;
    $host = DB_HOSTNAME;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;

    try {
        $db = new PDO("mysql:dbname=$db;host=$host", $username, $password);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'データベースに接続できません！アプリの設定を確認してください。';
        exit;
    }

    return $db;
}

// Postの値を受け取って、求人応募一覧を配列で返す
function fetchRecruitmentList(array $request) :array
{
    $db = dbConnect();

    $where = [];
    if (!empty($request['name_sei'])) {
        $where[] = "name_sei like '%{$request['name_sei']}%'";
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
        $experiencePgs = implode("','", $request['experience_pg']);
        $where[] = "experience_pg in ('{$experiencePgs}')";
    }

    if ($where) {
        $whereSql = implode(' AND ', $where);
        $sql = 'select * from job_application where ' . $whereSql;
    } else {
        $sql = 'select * from job_application';
    }

    $stm = $db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}

function findRecruitment(array $request)
{

}