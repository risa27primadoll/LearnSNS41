<?php
// session変数を使えるようにする
session_start();
//DBに接続
require("dbconnect.php");
// feed_idを取得
$follower_id = $_GET["follower_id"];

$user_id = $_SESSION["id"];
//SQL文作成（DELETE文）
$sql = "DELETE FROM `followers` (`id`, `user_id`, `follower_id`) VALUES (NULL, ?, ?);";
// SQL実行
$data = array($user_id,$follower_id);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

//一覧に戻る
header("Location: profile.php?user_id=".$follower_id);

?>