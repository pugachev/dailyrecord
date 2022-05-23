<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List</title>

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--Font Awesome5-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <!--自作CSS -->
    <style type="text/css">
      .form-control::form-check-inline{
          /* ルート要素の文字サイズを変更する */
          font-size: 24px;
      } 
    </style>
</head>
<body>
<!-- Navigation -->
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

  <div class="jumbotron">
    <div class="container-fluid text-center">
        <h1>List</h1>
    </div>
  </div>

<div class="container mt-3">
    <div class="panel panel-default">
      <div class="panel-body mb-3">
        <form class="form-inline">
          <div class="form-group col-md-6">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="form-check-label align-top h4" for="inlineRadio1">食品</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="form-check-label align-top h4" for="inlineRadio2">日用品</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                <label class="form-check-label align-top h4" for="inlineRadio3">熱量</label>
              </div>
          </div>
          <div class="form-group">
            <div class="form-rowml-3 mr-3  col-md-3">
                <input type="text" class="form-control align-text-bottom" id="calendar" placeholder="対象日">
              </div>
          </div>
          <button class="btn align-top btn-primary  col-md-3">検索</button>
        </form>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>名前</th>
            <th>背番号</th>
            <th>投/打</th>
            <th>ポジション</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>有原航平</td>
            <td>16</td>
            <td>右/右</td>
            <td>投手</td>
          </tr>
          <tr>
            <td>西川遥輝</td>
            <td>7</td>
            <td>右/左</td>
            <td>外野手</td>
          </tr>
          <tr>
            <td>中島卓也</td>
            <td>9</td>
            <td>右/左</td>
            <td>内野手</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/locales/bootstrap-datepicker.ja.min.js"></script>

<script>

    // 無効なフィールドがある場合にフォーム送信を無効にするスターターJavaScriptの例
    (function() {
        $('#calendar').datepicker({
        format: 'yyyy-mm-dd',
        language:'ja',
        autoclose:'true'
      });

    //   $('#inlineRadio1').click(function () {
    //     $('html').css('font-size', '0.8rem');
    //     });

    //     $('#inlineRadio2').click(function () {
    //         $('html').css('font-size', '0.9rem');
    //     });

    //     $('#inlineRadio3').click(function () {
    //         $('html').css('font-size', '1.0rem');
    //     });
    })();
</script>
</body>
</html>
