<?php
include 'lib/connect.php';
include 'lib/calorie.php';
include 'lib/queryCalorie.php';

if(!empty($_POST['tgtdate']) && !empty($_POST['tgtcategory']) && !empty($_POST['tgtitem']) && !empty($_POST['tgtquantity']))
{

  $rcvDate = $_POST['tgtdate'];
  $rcvCategory = $_POST['tgtcategory'];
  $rcvItem = $_POST['tgtitem'];
  $rcvQuantity = $_POST['tgtquantity'];

  // print_r($rcvDate.' '.$rcvCategory.' '.$rcvItem.' '.$rcvQuantity);
  // die();

  $calorie = new Calorie();
  $calorie->setDate($rcvDate);
  $calorie->setCategory($rcvCategory);
  $calorie->setItem($rcvItem );
  $calorie->setQuantity($rcvQuantity);
  $calorie->save();

  
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calorie Intake</title>

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--Font Awesome5-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <!--自作CSS -->
    <style type="text/css">
      /* .container{
        margin: 0 auto;
      }
      #einput{
        margin: 0 auto;
        font-size: 26px;
      } */
      .form-control::placeholder{
          /* ルート要素の文字サイズを変更する */
          font-size: 24px;
      } 
      .form-control::option{
          /* ルート要素の文字サイズを変更する */
          font-size: 24px;
      } 
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Navbar</a>
        <button class="navbar-toggler" type="button"
            data-toggle="collapse"
            data-target="#navmenu1"
            aria-controls="navmenu1"
            aria-expanded="false"
            aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu1">
          <div class="navbar-nav">
            <a class="nav-item nav-link" href="#">Foods Expensive</a>
            <a class="nav-item nav-link" href="#">Goods Expensive</a>
            <a class="nav-item nav-link" href="#">Calorie Intake</a>
          </div>
        </div>
      </nav>

<!-- <div class="page-header">
  <h1 class="bg-info text-center">出費入力画面</h1>
</div> -->
<div class="jumbotron">
  <div class="container-fluid text-center">
      <h1>Calorie Intake</h1>
  </div>
</div>
<!-- Page Content -->
<div class="container mt-xl-5 mx-auto align-items-center">

    <form id="einput" action="cinput.php" method="post">

        <!--日付-->
        <div class="form-row form-inline mt-2 mb-3">
          <label for="calendar" class="col-md-3 h3">日付</label>
          <input type="text" class="form-control col-md-9 h3" id="calendar" placeholder="対象日" name="tgtdate">
        </div>
        <!--/日付-->

        <!--分類-->
        <div class="form-row form-inline mt-2 mb-3">
            <label for="cate_select" class="col-md-3 h3">分類:</label>
            <select id="cate_select" class="form-control col-md-9 h3" name="tgtcategory">
              <option class="h4">分類</option>
              <option class="h4">インスタント</option>
              <option class="h4">麺類</option>
              <option class="h4">野菜</option>
            </select>
          </div>
          <!--/分類-->
  
          <!--項目-->
          <div class="form-row form-inline mt-2 mb-3">
            <label for="item_select" class="col-md-3 h3">項目:</label>
            <select id="item_select" class="form-control col-md-9" name="tgtitem">
              <option class="h4">項目</option>
              <option class="h4">ラーメン</option>
              <option class="h4">カレー</option>
              <option class="h4">ご飯</option>
            </select>
          </div>
          <!--/項目-->

        <!--数量-->
        <div class="form-row form-inline mt-2 mb-3">
          <label for="price" class="col-md-3 h3">数量</label>
          <input type="text" class="form-control col-md-9 h4" id="price" placeholder="数量" name="tgtquantity">
        </div>
        <!--/数量-->



        <!--ボタンブロック-->
        <div class="form-group form-inline row mt-5">
            <div class=" col-md-4 col-sm-12 mb-3">
                <button type="submit" class="btn btn-primary btn-block btn-lg">登録</button>
            </div>
            <div class=" col-md-4 col-sm-12 mb-3">
                <button type="submit" class="btn btn-primary btn-block btn-lg">削除</button>
            </div>
            <div class=" col-md-4 col-sm-12 mb-3">
                <button type="submit" class="btn btn-primary btn-block btn-lg">戻る</button>
          </div>
        </div>
        <!--/ボタンブロック-->

    </form>

</div><!-- /container -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/locales/bootstrap-datepicker.ja.min.js"></script>

<!-- Validation -->
<script>

    // 無効なフィールドがある場合にフォーム送信を無効にするスターターJavaScriptの例
    (function() {
      $('#calendar').datepicker({
        format: 'yyyy-mm-dd',
        language:'ja',
        autoclose:'true'
      });

    })();
</script>
</body>
</html>
