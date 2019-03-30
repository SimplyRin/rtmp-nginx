<!--
Created by SimplyRin on 2019/03/30.

Copyright (c) 2019 SimplyRin

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:
 *
The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.
 *
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->
<?php
$application = $_GET["application"];
$url = $_GET["url"];
$streamKey = $_GET["streamKey"];
?><!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Nginx Restream</title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <style type="text/css">
  body { padding-top: 80px; }
  @media ( min-width: 768px ) {
    #banner {
      min-height: 300px;
      border-bottom: none;
    }
    .bs-docs-section {
      margin-top: 8em;
    }
    .bs-component {
      position: relative;
    }
    .bs-component .modal {
      position: relative;
      top: auto;
      right: auto;
      left: auto;
      bottom: auto;
      z-index: 1;
      display: block;
    }
    .bs-component .modal-dialog {
      width: 90%;
    }
    .bs-component .popover {
      position: relative;
      display: inline-block;
      width: 220px;
      margin: 20px;
    }
    .nav-tabs {
      margin-bottom: 15px;
    }
    .progress {
      margin-bottom: 10px;
    }
  }
  </style>
</head>
<body>

<header>
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class="navbar-brand">Nginx Restream</a>
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="navbar-collapse collapse" id="navbar-main">
        <ul class="nav navbar-nav">
          <li><a href="index.html">Top</a></li>
          <li><a href="settings.php">Settings</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<div class="container">

  <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="container">Welcome.</h1>
        </div>
        <div class="bs-component">
          <div class="jumbotron">
            <div></div>
            <h1>Restream Editor</h1>
            <label>配信サイト: <input id="application" class="form-control input-sm"></input></label>
            <p></p>
            <label>URL: <input id="url" class="form-control input-sm"></input></label>
            <p></p>
            <label>ストリームキー: <input id="streamKey" class="form-control input-sm"></input></label>
            <p></p>
            <a href="#" class="btn btn-primary btn-lg" onclick="return _save();">追加</a>
          </div>
        </div>
      </div>
    </div>
</div>
  <script>
    function create() {
      location.assign('add.php');
    }

    function _save() {
      var application = document.getElementById("application").value;
      var url = document.getElementById("url").value;
      var streamKey = document.getElementById("streamKey").value;

      $.ajax({
        url: 'file.php?type=save&file=' + application + "&content=" + application + " " + url + " " + streamKey
      }).done(function (data) {
        $.ajax({
          url: 'update.php'
        }).done(function (data) {
        });
        location.assign('settings.php');
        swal('設定成功', '新しい Restream を作成しました。', 'success');
        var countup = function(){
          location.assign('settings.php');
        } 
        setTimeout(countup, 4000);
      });
    }

    document.getElementById("application").value = "<?php print($application) ?>";
    document.getElementById("url").value = "<?php print($url) ?>";
    document.getElementById("streamKey").value = "<?php print($streamKey) ?>";
  </script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="css/sweetalert2.css">

<script src="js/swal-forms.js"></script>
<link rel="stylesheet" href="css/swal-forms.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
  $('.bs-component [data-toggle="popover"]').popover();
  $('.bs-component [data-toggle="tooltip"]').tooltip();
</script>

</body>
</html>
