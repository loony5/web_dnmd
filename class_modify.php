<!DOCTYPE html>
<?php
  session_start();
  include "include/connect.php";

  $no = $_GET['no'];
  $sql = "SELECT *FROM class WHERE no = $no";
  $result = $connect->query($sql);
  $row = $result->fetch_assoc();

  $title = $row['title'];
  $teacher = $row['teacher'];
  $date = $row['date'];
  $time = $row['time'];
  $place = $row['place'];
  $peoples = $row['peoples'];
  $charge = $row['charge'];
  $content = $row['content'];

  $image = $row['image']['name'];


  if(!isset($_SESSION['ses_userid']) || $_SESSION['ses_userid'] != 'admin'){

    ?>
    <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo "index.php"?>");
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

      <?php include 'view/top_view.php'?>

      <div class="container" style="margin-bottom:100px">
        <h2 class="text-center" style="margin-top:30px; margin-bottom:50px">수업 등록</h2>

        <div class="row">
          <div class="col-lg-2"></div>

          <div class="col-lg-7 text-center" style="margin-left:5px">
            <form class="form-horizontal" action="class_modify_action.php" method="post" enctype="multipart/form-data">
              
              <input type="hidden" name="size" value="1000000">
              <input type="hidden" name="no" id="no" value="<?=$no?>">
              
              <div class="form-group">
                <label for="title" class="col-lg-2 control-label">수업명</label>
                <div class="col-lg-10">
                  <input id="title" class="form-control" type="text" name="title" value="<?=$title?>">
                </div>
              </div>

              <div class="form-group">
                <label for="teacher" class="col-lg-2 control-label">강사</label>
                <div class="col-lg-10">
                  <input id="teacher" class="form-control" type="text" name="teacher" value="<?=$teacher?>">
                </div>
              </div>

              <div class="form-group">
                <label for="date" class="col-lg-2 control-label">일자</label>
                <div class="col-lg-10">
                  <input id="date" class="form-control" type="text" name="date" value="<?=$date?>">
                </div>
              </div>

              <div class="form-group">
                <label for="time" class="col-lg-2 control-label">시간</label>
                <div class="col-lg-10">
                  <input id="time" class="form-control" type="text" name="time" value="<?=$time?>">
                </div>
              </div>

              <div class="form-group">
                <label for="place" class="col-lg-2 control-label">장소</label>
                <div class="col-lg-10">
                  <input id="place" class="form-control" type="text" name="place" value="<?=$place?>">
                </div>
              </div>

              <div class="form-group">
                <label for="peoples" class="col-lg-2 control-label">인원</label>
                <div class="col-lg-10">
                  <input id="peoples" class="form-control" type="text" name="peoples" value="<?=$peoples?>">
                </div>
              </div>

              <div class="form-group">
                <label for="charge" class="col-lg-2 control-label">비용</label>
                <div class="col-lg-10">
                  <input id="charge" class="form-control" type="text" name="charge" value="<?=$charge?>">
                </div>
              </div>

              <div class="form-group">
                <label for="content" class="col-lg-2 control-label">수업내용</label>
                <div class="col-lg-10">
                  <textarea id="content" class="form-control" rows="15" name="content"><?=$content?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="image" class="col-lg-2 control-label">이미지</label>
                <div class="col-lg-10" style="margin-top:7px">
                  <input id="image" type="file" name="image"">
                </div>
              </div>

              <div class="form-group">
                <label for="image" class="col-lg-2 control-label">기존이미지</label>
                <div class="col-lg-10">
                  <input id="image" type="hidden" name="image">
                  <p class="text-left" style="margin-top:7px"><?php echo isset($row['image'])?$row['image']:null?></p>
                </div>
              </div>

              <div class="form-group">
                <label for="btn" class="col-lg-2 control-label"></label>
                <div class="col-lg-10">
                <button class="btn btn-lg btn-info" type="submit" style="width: 100%;margin-top:30px">수정완료</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>

      <?php include 'view/bottom_view.php'; ?>

    </body>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>

  </html>
