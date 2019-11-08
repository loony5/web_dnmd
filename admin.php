<!DOCTYPE html>

<?php

  session_start();
  include 'include/connect.php';

  if(!isset($_SESSION['ses_userid']) || $_SESSION['ses_userid'] !== 'admin') {

    ?>

    <script>
      alert("권한이 없습니다.");
      location.replace("<?php echo 'index.php' ?>");
    </script>

    <?php
  }

  // 페이징
  if(isset($_GET['page'])) {
      
    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  $sql = "SELECT count(*) as cnt FROM class ORDER BY NO DESC";
  $result = $connect->query($sql);
  $row = $result->fetch_assoc();

  $allPost = $row['cnt'];
  $onePage = 9;
  $allPage = ceil($allPost / $onePage);

  if($page < 1 || ($allPage && $page > $allPage)) {

    ?>

    <script>
      alert("존재하지 않는 페이지입니다.");
      history.back();
    </script>

    <?php

    exit;

  }

  $oneSection = 5;
  $currentSection = ceil($page / $oneSection);
  $allSection = ceil($allPage / $oneSection);
  $firstPage = ($currentSection * $oneSection) - ($oneSection - 1);

  if($currentSection == $allSection) {

    $lastPage = $allPage;
  } else {

    $lastPage = $currentSection * $oneSection;
  }

  $prevPage = (($currentSection - 1) * $oneSection);
  $nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1);

  $paging = '<ul class="pagination">';

  for($i = $firstPage; $i <= $lastPage; $i++) {

    if($i == $page) {

      $paging .= '<li class="active"><span>' . $i . '<span class="sr-only">(current)</span></span></li>';
    } else {

      $paging .= '<li><a href="admin.php?page=' . $i . '">' . $i . '</a></li>';
    }

  }

  $paging .= '</ul>';

  $currentLimit = ($onePage * $page) - $onePage;
  $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage;
  $sql = 'SELECT * FROM class ORDER By NO DESC' . $sqlLimit;

  $result = $connect->query($sql);

?>


<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width", initial-scale="1">
  <title>D.NMD</title>
  <link rel="stylesheet" href="css/bootstrap.css">

  <style>
    th {
      text-align: center;
    }

    .td-ellipsis {
      display: inline-block;
      width: 150px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  </style>
</head>
<body>

  <?php include 'view/top_view.php'?>

  <div class="container">
    <h2 class="text-center" style="margin-top:30px; margin-bottom:50px">관리페이지</h2>

    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="admin.php">수업관리</a></li>
        <li rold="presentation"><a href="inquiry_board.php">1:1 문의글 관리</a></li>
    </ul>

    <ol class="breadcrumb" style="height:50px; margin-top:15px; padding-top:15px; padding-bottom:15px">
        <li class="active">진행중</li>
        <li><a href="finish_class.php">마감</a></li>
    </ol>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>no</th>
            <th>이미지</th>
            <th>수업명</th>
            <th>강사</th>
            <th>일자</th>
            <th>시간</th>
            <th>정원</th>
            <th>참여인원</th>
            <th>수업료</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          <?php 
            
            $memberId = $_SESSION['ses_userid'];

            while($row = $result->fetch_assoc()) {

              $classNo = $row['no'];
              $query = "SELECT count(*) as cnt FROM payment_list WHERE num = '$classNo'";
              $pay_row=mysqli_fetch_assoc($connect->query($query));

              $remainder = $row['peoples'] - $pay_row['cnt'];
          ?>
          <tr>
            <td style="text-align: center"><?php echo $row['no']?></td>
            <td><img class="img-rounded" width="50px" src="images/<?php echo $row['image']?>"></td>
            <td><a href="class_detail.php?no=<?php echo $row['no']?>" class="td-ellipsis" style="width:200px"><?php echo $row['title']?></td>
            <td><p class="td-ellipsis"><?php echo $row['teacher']?></p></td>
            <td><p class="td-ellipsis"><?php echo $row['date']?></p></td>
            <td style="text-align: center"><p class="td-ellipsis" style="width:100px"><?php echo $row['time']?></p></td>
            <td style="text-align: center"><?php echo $row['peoples']?></td>
            <td style="text-align: center">
                
              <?php if($row['peoples'] == $pay_row['cnt']) {?>
              
              <span style="color:red">마감</span>

              <?php } 
              
              else if($remainder<=2 && $remainder!=0) {
                  
                  echo $pay_row['cnt']; ?> </br><span style="color:red">마감임박</span> <?php

              } else { echo $pay_row['cnt']; } ?></td>
            
            <td style="text-align: center"><?php echo number_format($row['charge'])?>원</td>
            <td><input type="hidden" name="no" value="<?php echo $row['no']?>">
            <input class="btn btn-default" type="button" name="modify_btn" value="수정" onclick="location.href='class_modify.php?no=<?php echo $row['no']?>'">
            <input class="btn btn-default" type="button" name="delete_btn" value="삭제" onclick="location.href='delete_check.php?no=<?php echo $row['no']?>'"></td>
          </tr>

          <?php } ?>

        </tbody>
      </table>


    </div>

    <div class="col-md-4"></div>

    <div class="col-md-4" style="margin-top:20px; margin-bottom:20px">
        <a class="btn btn-lg btn-info btn-block" href="class_register.php">수업등록</a>
    </div>
      
  </div>

  <div class="paging" align=center>
    <?php echo $paging ?>
  </div>

  <?php include 'view/bottom_view.php'; ?>

</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>

</html>