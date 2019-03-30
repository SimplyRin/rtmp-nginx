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
<!DOCTYPE html>
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
  <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script>
    function create() {
      location.assign('add.php');
    }

    function _edit($application, $url, $streamKey) {
      location.assign('add.php?application=' + $application + "&url=" + $url + "&streamKey=" + $streamKey);
    }

    function _delete($file) {
      swal({
        title: '実行しますか？',
        text: '本当に "' + $file + '" を削除しますか？\nこのアクションを行うと現在有効のストリーミングは停止されます。',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: '削除',
        cancelButtonText: 'キャンセル',
        showLoaderOnConfirm: true
      }).then((result) => {
        if (result) {
          $.ajax({
            url: 'file.php?type=delete&file=' + $file
          }).done(function (data) {
            $.ajax({
              url: 'update.php'
            }).done(function (data) {
            });
            swal('削除成功', 'ファイルを削除しました。', 'success');
            var countup = function(){
              location.assign('settings.php');
            } 
            setTimeout(countup, 1000);
          });
        } else {
          // Cancel
        }
      })
    }
  </script>
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
          <li class="active"><a href="#">Settings</a></li>
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
            <h1>Nginx Restream</h1>
            <p>RTMP URL: rtmp://SERVER_IP/VtpuThYDxfND</p>
            <a href="#" class="btn btn-primary btn-lg" onclick="return create();">新規作成</a>
          </div>
        </div>
        <div class="bs-component">
          <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>アプリケーション名</th>
                <th>URL</th>
                <th>ストリームキー</th>
                <th>アクション</th>
              </tr>
            </thead>
            <tbody> <?php
                $lst = array();
                $dhandle = opendir("./nginx/list/");
                if ($dhandle) {
                  $count = 0;
                  while (false !== ($fname = readdir($dhandle))) { // <a href="#" class="btn btn-success btn-xs" onclick="_view(\'' . $fname . '\');">View</a> 
                    if ($fname != '.' && $fname != '..') {
                      $count++;

                      $split = split(file_get_contents("./nginx/list/" . $fname), " ");

                      print('
              <tr>
                <td>' . $count . '</td>
                <td>' . $split[0] . '</td>
                <td>' . $split[1] . '</td>
                <td>' . $split[2] . '</td>
                <td><a href="#" class="btn btn-primary btn-xs" onclick="_edit(\'' . $split[0] . "', '" . $split[1] . "', '" . $split[2] . '\');">Edit</a> <a href="#" class="btn btn-danger btn-xs" onclick="_delete(\'' . $fname . '\');">Delete</a></td>
              </tr>');
                    }
                  }
                  closedir($dhandle);
                }
              ?>
            </tbody>
          </table>
        </div><!-- /example -->
      </div>
    </div>

</div>


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

<?php
function split($content, $split) {
  return explode($split, $content);
}

function generate($content) {
  $result = "";


}
?>

