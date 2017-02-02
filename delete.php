<html>
  <head>
    <title>blog delete</title>
    <meta charset="utf-8">
  </head>

  <body>
    <h1>ブログ記事削除</h1>

<?php

try{
  //PDOクラスのオブジェクトの作成
  $dbh = new PDO('sqlite:blog.db','','');

  if(isset($_POST["id"])){
    if(!isset($_POST["password"]) || $_POST["password"]!='pass'){
      echo '<p>パスワードが違います</p>';
    }else{
      //実行するSQL文を$sqlに格納
      $sql = 'delete from posts where id = ?';
      //prepareメソッドでSQL文の準備
      $sth = $dbh->prepare($sql);
      //prepareした$sthを実行 SQL文の?部に格納する変数を指定。
      $sth->execute(array($_POST["id"]));

      if($sth){
        echo "記事１件を削除しました";
      }else{
        echo "記事１件の削除に失敗しました";
      }

    }
  }
  if(isset($_POST["pid"])){

    $pid = $_POST["pid"];
    $sqlpass = "select pass from comments where id = $pid";
    $stmt = $dbh->query($sqlpass);
    $truepass = $stmt->fetch(PDO::FETCH_ASSOC);


    if(!isset($_POST["commentpass"]) || $_POST["commentpass"]!=$truepass['pass']){
      echo '<p>パスワードが違います</p>';
    }else{
      //実行するSQL文を$sqlに格納
      $sql = 'delete from comments where id = ?';
      //prepareメソッドでSQL文の準備
      $sth = $dbh->prepare($sql);
      //prepareした$sthを実行 SQL文の?部に格納する変数を指定。
      $sth->execute(array($_POST["pid"]));

      if($sth){
        echo "コメント１件を削除しました";
      }else{
        echo "コメント１件の削除に失敗しました";
      }

    }
  }

}Catch (PDOException $e) {
  print "エラー!: " . $e->getMessage() . "<br/>";
  die();
}

?>

<p><a href="index.php">blog閲覧ページはこちら</a></p>

  </body>
</html>