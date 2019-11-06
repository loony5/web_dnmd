<?php
  include "include/connect.php";
  session_start();

  $no = $_GET['no'];
  $sql = "SELECT * FROM board WHERE no=$no";
  $result = $connect->query($sql);
  $row = $result->fetch_assoc();

  $title = $row['title'];
  $content = $row['content'];
  $memberId = $row['memberId'];
  $name = $row['name'];

  if(!isset($_SESSION['ses_userid'])){

    ?>
    <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo "main.php"?>");
    </script>
    <?php
  } else if ($_SESSION['ses_userid'] != $memberId) {
    ?>

    <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo "main.php"?>");
    </script>
    <?php
      }
      ?>

  <html>
    <head>
      <meta charset="utf-8">
      <title>D.NMD</title>
      <link rel="stylesheet" href="css/bootstrap.css">
    </head>

    <body>

      <?php include 'view/top_view.php'?>

      <div class="container" style="margin-bottom:100px">
      <h2 class="text-center" style="margin-top:30px; margin-bottom:50px">1:1 문의하기</h2>

      <div class="row">

        <div class="col-lg-2">
        </div>

        <div class="col-lg-7 text-center" style="margin-left:5px">
          <form class="form-horizontal" action="inquiry_modify_action.php" method="post">

            <div class="form-group">
              <label for="memberId" class="col-lg-2 control-label">작성자</label>
              <div class="col-lg-10">
                <input type="hidden" name="memberId" id="memberId" value="<?=$_SESSION['ses_userid']?>">
                <p class="text-left" style="padding-top:7px"><?=$name?></p>
              </div>
            </div>

            <div class="form-group">
              <label for="title" class="col-lg-2 control-label">제목</label>
              <div class="col-lg-10">
                <input id="title" class="form-control" type="text" name="title" value="<?=$title?>">
              </div>
            </div>

            <div class="form-group">
              <label for="content" class="col-lg-2 control-label">내용</label>
              <div class="col-lg-10">
                <textarea id="content" class="form-control" rows="15" name="content"><?=$content?></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="btn" class="col-lg-2 control-label"></label>
              <div class="col-lg-10">
                <input type="hidden" name="name" id="name" value="<?=$name?>">
                <input type="hidden" name="no" id="no" value="<?=$no?>">  
                <button class="btn btn-lg btn-info" type="submit" style="width: 100%; margin-top: 15px">수정하기</button>
              </div>
            </div>

          </form>
        </div>

      </div>
    </div>

    <?php include 'view/bottom_view.php'; ?>

    </body>
  </html>
