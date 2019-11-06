<!DOCTYPE html>
<?php
  session_start();
  include 'include/connect.php';


  // 페이징
  if(isset($_GET['page'])) {

    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  $sql = 'SELECT COUNT(*) as cnt FROM class ORDER BY NO DESC';
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

  $oneBlock = 5;
  $currentBlock = ceil($page / $oneBlock);
  $allBlock = ceil($allPage / $oneBlock);
  $firstPage = ($currentBlock * $oneBlock) - ($oneBlock - 1);

  if($currentBlock == $allBlock) {

    $lastPage = $allPage;

  } else {

    $lastPage = $currentBlock * $oneBlock;

  }

  $prevPage = (($currentBlock - 1) * $oneBlock);
  $nextPage = (($currentBlock + 1) * $oneBlock) - ($oneBlock - 1);

  $paging = '<ul class="pagination">';

  for($i = $firstPage; $i <= $lastPage; $i++) {

    if($i == $page) {

      $paging .= '<li class="active"><span>' . $i . '<span class="sr-only">(current)</span></span></li>';

    } else {

      $paging .= '<li><a href="main.php?page=' . $i . '">' . $i . '</a></li>';

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
  </head>

  <body>

    <style type="text/css">
    .navbar-text {

      padding: 0 0 0 15px;
    }
    </style>

    <!-- 상당 네비게이션 바 -->
    <?php include 'view/top_view.php'?>


    <div class="container">
    
      <!-- 메인 소개글 -->
      <div class="jumbotron">
        <h1 class="text-center">D.NMD</h1>
        <p class="text-center"><br>
        "아날로그적 지식과 경험을 공유하다"<br></p>
        <p class="text-center">
        디노마드학교는 디자인 및 문화예술 분야의 지식과 경험을 공유하는 장입니다.</br>
        이를 통해 학교와 직장의 울타리를 벗어난 창조적 커뮤니케이션을 지향합니다.
        </p>
      </div>

      <!-- 본문 진행중인 수업 보여주기 -->
      <div class="row">

        <!-- 데이터베이스에 저장된 수업 가져오기 -->
        <?php 
        
        while($row=$result->fetch_assoc()) {

        $classNo = $row['no'];
        $query = "select count(*) as cnt from payment_list where num = '$classNo'";
        $res = $connect->query($query);
        $ro = $res->fetch_assoc();

        $peoples = $row['peoples'];
        $cnt_p = $ro['cnt'];

        $remainder = $peoples-$cnt_p;

        ?>

        <!-- 가져온 수업 보여주기 -->
        <div class="col-sm-6 col-md-4">
          <a href="class_detail.php?no=<?php echo $row['no'] ?>" class="thumbnail">
            <img src="images/<?=$row['image']?>" alt="">
            <div class="caption">
              <h3>
                <?php if($remainder<=2 && $remainder !=0) { echo $row['title']; ?>
                <span style="color:red">-마감임박</span><?php } else { echo $row['title']; } ?></h3>
            </div>
          </a>
        </div>

      <?php } ?>

      </div>
        
    </div>


  <div class="text-center">
  <?php echo $paging ?>
  </div>

  <?php include 'view/bottom_view.php'; ?>

  </body>

</html>
