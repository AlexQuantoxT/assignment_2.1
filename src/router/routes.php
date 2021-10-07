<?php
// echo __DIR__ . "/assignment_2.1/src/router/router.php";
require_once(__DIR__ . "/router.php");

get('/mentor', '../apis/MentorApi.php');


any('/404', 'www/assignment_2.1/src/router/404.php');