<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'config.php';
require_once 'master.php';

$masterObj = new Master($client_id, $email, $name);

$register_url = $base_url . $register_endpoint;
$registerObj = $masterObj->getToken($register_url);

$sl_token = $registerObj->sl_token;
$posts_url = $base_url . $posts_endpoint . $sl_token;

$allPosts = $masterObj->getAllPosts($posts_url);
$monthPosts = $masterObj->getPostsByMonth($allPosts);

$avgLength = $masterObj->getAverageLength($monthPosts);
$longPost = $masterObj->getLongestPost($monthPosts);
$postsByWeek = $masterObj->getPostsByWeek($allPosts);
$postsByUsers = $masterObj->getPostsByUsers($monthPosts);

$combinedResult = array(
    "avgLength" => $avgLength,
    "longPost" => $longPost,
    "postsByWeek" => $postsByWeek,
    "postsByUsers" => $postsByUsers
);
//debug($combinedResult);

header('Content-Type: application/json');
echo json_encode($combinedResult);

