<html>
  <head>
    <meta charset="utf-8">
    <title>コメントの投稿</title>
  </head>
  <body><h1>コメント投稿</h1>

  <?php
  try{

    //PDOクラスのオブジェクトの作成
    $dbh = new PDO('sqlite:blog.db','','');


    if($_POST["name"] == NULL){
      $_POST["name"] = "名無し";
    }
    if($_POST["contents"] == NULL){
      echo "コメント本文を入力してください";
    }else{

      //タイムゾーンの指定
      ini_set("date.timezone", "Asia/Tokyo");
      //$timeへ成形した年月日および時刻データを格納
      $time=date("Y m d D H i");

      $sql = 'INSERT INTO comments(pid,contents,date,name,pass) VALUES(?,?,?,?,?)';
      
      $sth = $dbh->prepare($sql);

      $sth->execute(array($_POST["pid"],$_POST["contents"],$time,$_POST["name"],$_POST["commentpass"]));

      if($sth) {
         echo "コメントを１件投稿しました";
      }else{
         echo "コメントの投稿に失敗しました";
      }
    }

  }catch(PDOException $e){
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }

  ?>

  <p><a href="index.php">blog閲覧ページはこちら</a></p>

  </body>
</html>