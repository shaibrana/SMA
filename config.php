<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set('display_errors', '1');
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);

$base_url = "https://api.supermetrics.com/assignment/";
$register_endpoint = "register";
$posts_endpoint = "posts?sl_token=";
$client_id = "ju16a6m81mhid5ue1z3v2g0uh";
$email = "shoaibmanzoor786@gmail.com";
$name = "Shoaib Manzoor";

function debug($param){
    echo "<pre>";
    print_r($param);
    exit;
}