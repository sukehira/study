<?php
require_once 'config/env.php';
require_once 'lib/function.php';

if ($_GET['id']) {
    deleteRecruitment($_GET['id']);
}

header("Location: http://localhost:8080/index.php");
