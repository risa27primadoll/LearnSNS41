<?php 
session_start();
 require("dbconnect.php");


echo "<pre>";
var_dump($_POST);
echo "</pre>";

$login_user_id = $_SESSION["id"];
$comment = $_POST["write_comment"];
$feed_id = $_POST["feed_id"];

//コメントをINSERTするSQL文作成
$sql = 'INSERT INTO `comments`(`comment`, `user_id`, `feed_id`, `created`) VALUES (?,?,?,now());';


//SQL文実行
  $data = array($comment,$login_user_id,$feed_id);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);


// timeline.php(一覧)に戻る
header('Location: timeline.php');
?>