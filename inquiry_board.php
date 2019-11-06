<!DOCTYPE html>

<?php

  session_start();
  include 'include/connect.php';

  if(!isset($_SESSION['ses_userid']) || $_SESSION['ses_userid'] !== 'admin') {

    ?>

    <script>
        alert("권한이 없습니다.");
        location.replace("<?php echo 'main.php' ?>");
    </script>

    <?php
  }

  // 페이징
  if(isset($_GET['page'])) {
      
    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  $sql = "SELECT count(*) as cnt FROM board ORDER BY NO DESC";
  $result = $connect->query($sql);
  $row = $result->fetch_assoc();

  $allPost = $row['cnt'];
  $onePage = 10;
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

      $paging .= '<li><a href="inquiry_board.php?page=' . $i . '">' . $i . '</a></li>';
    }

  }

  $paging .= '</ul>';

  $currentLimit = ($onePage * $page) - $onePage;
  $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage;
  $sql = 'SELECT * FROM board ORDER By NO DESC' . $sqlLimit;

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

    body {
        height: 100%;
      }
      
    .container {
      position:relative;
      min-height: 100%;
    }

    footer {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
    }

  </style>
</head>
<body>

  <?php include 'view/top_view.php'?>

  <div class="container">
    <h2 class="text-center" style="margin-top:30px; margin-bottom:50px">관리페이지</h2>

    <ul class="nav nav-tabs">
      <li role="presentation"><a href="admin.php">수업관리</a></li>
      <li rold="presentation" class="active"><a href="inquiry_board.php">1:1 문의글 관리</a></li>
    </ul>

    <div class="table-responsive" style="margin-top:15px">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>no</th>
            <th>제목</th>
            <th>작성자</th>
            <th>작성일</th>
            <th>답변상태</th>
          </tr>
        </thead>

        <tbody>
          <?php 
            
            $memberId = $_SESSION['ses_userid'];

            while($row = $result->fetch_assoc()) {

              $num = $row['no'];

          ?>
          <tr>
            <td style="text-align: center"><?php echo $row['no']?></td>
            <td><a href="inquiry_view.php?no=<?php echo $row['no']?>" class="td-ellipsis" style="width:200px"><?php echo $row['title']?></td>
            <td style="text-align: center"><p><?php echo $row['memberId']?></p></td>
            <td style="text-align: center"><p><?php echo $row['date']?></p></td>
            <td style="text-align: center">
                
              <?php 
              
              $sql = "SELECT *FROM comment WHERE num = '$num'";
              $comment_row = mysqli_fetch_assoc($connect->query($sql));
              
              if(isset($comment_row)) {?>
              
              <span style="color:red">답변완료</span>

              <?php } 
              
              else {
                ?> <span>진행중</span> 
                
                <?php

              } ?>
                
            </td>
              
          </tr>

          <?php } ?>

        </tbody>
      </table>
    </div>

  </div>

  <div class="paging" align=center>
      <?php echo $paging ?>
  </div>

  <?php include 'view/bottom_view.php'; ?>

</body>
</html>