<!DOCTYPE html>
<?php
  session_start();
  include "include/connect.php";
  if(!isset($_SESSION['ses_userid']) || $_SESSION['ses_userid'] != 'admin'){

    ?>
    <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo "main.php"?>");
    </script>
    <?php
  } ?>

  <html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width", initial-scale="1">
      <title>D.NMD</title>
      <link rel="stylesheet" href="css/bootstrap.css">
    </head>

    <body>

      <?php include 'top_view.php'?>

      <div class="container" style="margin-bottom:100px">
        <h2 class="text-center" style="margin-top:30px; margin-bottom:50px">수업 등록</h2>
        
        <div class="row">
          <div class="col-lg-2"></div>

          <div class="col-lg-7 text-center" style="margin-left:5px">
            <form class="form-horizontal" action="register_update.php" method="post" enctype="multipart/form-data">
              
              <input type="hidden" name="size" value="1000000">
              
              <div class="form-group">
                <label for="title" class="col-lg-2 control-label">수업명</label>
                <div class="col-lg-10">
                  <input id="title" class="form-control" type="text" name="title">
                </div>
              </div>

              <div class="form-group">
                <label for="teacher" class="col-lg-2 control-label">강사</label>
                <div class="col-lg-10">
                  <input id="teacher" class="form-control" type="text" name="teacher">
                </div>
              </div>

              <div class="form-group">
                <label for="date" class="col-lg-2 control-label">일자</label>
                <div class="col-lg-10">
                  <input id="date" class="form-control" type="text" name="date">
                </div>
              </div>

              <div class="form-group">
                <label for="time" class="col-lg-2 control-label">시간</label>
                <div class="col-lg-10">
                  <input id="time" class="form-control" type="text" name="time">
                </div>
              </div>

              <div class="form-group">
                <label for="place" class="col-lg-2 control-label">장소</label>
                <div class="col-lg-10">
                  <input id="place" class="form-control" type="text" name="place">
                </div>
              </div>

              <div class="form-group">
                <label for="peoples" class="col-lg-2 control-label">인원</label>
                <div class="col-lg-10">
                  <input id="peoples" class="form-control" type="text" name="peoples">
                </div>
              </div>

              <div class="form-group">
                <label for="charge" class="col-lg-2 control-label">비용</label>
                <div class="col-lg-10">
                  <input id="charge" class="form-control" type="text" name="charge">
                </div>
              </div>

              <div class="form-group">
                <label for="content" class="col-lg-2 control-label">수업내용</label>
                <div class="col-lg-10">
                  <textarea id="content" class="form-control" rows="15" name="content"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="image" class="col-lg-2 control-label">이미지</label>
                <div class="col-lg-10" style="margin-top:7px">
                  <input id="image" type="file" name="image"">
                </div>
              </div>

              <div class="form-group">
                <label for="btn" class="col-lg-2 control-label"></label>
                <div class="col-lg-10">
                <button class="btn btn-lg btn-info" type="submit" style="width: 100%;margin-top:30px">등록</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>

    </body>

  </html>
