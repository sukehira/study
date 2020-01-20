<?php
require_once 'config/env.php';
require_once 'lib/function.php';

if ($_GET['id']) {
    deleteRecruitment($_GET['id']);
}

redirect('index.php');