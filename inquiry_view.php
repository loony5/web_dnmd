<!DOCTYPE html>
<?php
  include "include/connect.php";
  session_start();

  $no = $_GET['no'];

  $sql = "SELECT * FROM board WHERE no =$no";
  $row = mysqli_fetch_assoc($connect->query($sql));

?>

<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width", initial-scale="1">
      <title>D.NMD</title>
      <link rel="stylesheet" href="css/bootstrap.css">
  </head>

  <body>

    <!-- 상단 네비게이션 바 -->
    <?php include 'top_view.php'?>

    <div class="container">
    <h2 class="text-center" style="margin-top:30px; margin-bottom:50px">1:1 문의하기</h2>

      <div class="row">
        <div class="col-lg-2"></div>

        <div class="col-lg-8">
          <div class="panel panel-default">
            <div class="panel-heading text-center"><?=$row['title']?></div>

            <div class="panel-body">

              <table class="table">
                <thead>
                  <tr>
                    <td><p>작성자 : <?=$row['name']?></p></td>
                    <td><p class="text-right">작성일 : <?=$row['date']?></p></td>
                  </tr>
                </thead>

                <tbody>
                  <td colspan="2"><p style="margin-top: 20px"><?=$row['content']?></p></td>
                </tbody>
              </table>
            </div>
          </div>

          <?php 

            if($_SESSION['ses_userid'] != 'admin') { ?>

            <div class="text-right">
              <button class="btn btn-default" onclick="location.href='inquiry_modify.php?no=<?php echo $no?>'">수정</button>
              <button class="btn btn-default" onclick="location.href='inquiry_delete.php?no=<?php echo $no?>'">삭제</button>
            </div>

            <?php
            } else { include 'comment.php';}
          ?>
        </div>
        </div>
      </div>
    </div>

  </body>
</html>
