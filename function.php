<?php 

//サインインしているユーザーの情報を取得して、返す関数
// 引数＄dbh：データベース接続オブジェクト
// 引数＄user＿id：サインインしているユーザーのid
//使い方はget_signin_user($dbh,$_SESSION)

function get_signin_user($db,$user_id)
{
　　
　　$sql = 'SELECT * FROM `users` WHERE `id`=?';


   $data = array($user_id);
　　$stmt = $dbh->prepare($sql);
　　$stmt->execute($data);

$signin_user = $stmt->fetch(PDO::FETCH_ASSOC); 


return $signin_user;


}



 ?>