<!DOCTYPE html>
<?php
  session_start();
  include '../dnmd/include/connect.php';


  // paging start
  if(isset($_GET['page'])) {

    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  $sql = 'select count(*) as cnt from class order by no desc';
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

  $paging = '<ul>';

  for($i = $firstPage; $i <= $lastPage; $i++) {

    if($i == $page) {

      $paging .= '<li class="page current">' . $i . '</li>';

    } else {

      $paging .= '<li class="page"><a href="./main.php?page=' . $i . '">' . $i . '</a></li>';

    }

  }

  $paging .= '</ul>';

  $currentLimit = ($onePage * $page) - $onePage;
  $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage;
  $sql = 'select * from class order by no desc' . $sqlLimit;

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


    <!-- 상단 네비게이션바 시작 -->
    <nav class="navbar navbar-default">
      
      <!-- 모바일 사이즈로 브라우저 너비가 좁아질 경우, 메뉴로 보여짐 -->
      <div class="navbar-header">
        <a class="navbar-brand" href="main.php">D.NMD</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <!-- 일반 브러우저 사이즈일때, 보여짐 -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          
          <!-- 로그인하지 않았을때, -->
          <?php
            if(!isset($_SESSION['ses_userid'])) { ?>
              <li><a href="login.php">로그인</a></li>
              <li><a href="join.php">회원가입</a></li>
              <li><a href="write.php">1:1문의하기</a></li>

              <!-- 로그인 했을때, -->
            <?php } else {

              $ses_userid=$_SESSION['ses_userid'];

              $name_sql="SELECT *FROM member WHERE memberId='$ses_userid'";
              $name_res=$connect->query($name_sql);
              $name_row=$name_res->fetch_assoc();
              $name = $name_row['name'];

              // 관리자가 로그인 했을때,
              if($_SESSION['ses_userid'] == 'admin') { ?>

                <p class="navbar-text">
                <?php echo "<strong>$name</strong> 님"?>
                </p>
                <li><a href="logout.php">로그아웃</a></li>
                <li><a href="admin.php">관리페이지</a></li>

                <!-- 일반 사용자가 로그인 했을때, -->
              <?php } else { ?>

                <p class="navbar-text">
                <?php echo "<strong>$name</strong> 님"?>
                </p>
                <li><a href="logout.php">로그아웃</a></li>
                <li><a href="write.php">1:1문의하기</a></li>
                <li><a href="my.php">나의 디노마드</a></li>

              <?php } 

             } ?>

        </ul>
      </div>
    </nav>


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
          <a href="detail.php?no=<?php echo $row['no'] ?>" class="thumbnail">
            <img src="images/<?=$row['image']?>" alt="" method="get">
            <div class="caption">
              <h3><?php echo $row['title']?></h3>
            </div>
          </a>
        </div>
      </div>

      <?php } ?>
        
    </div>


  <!-- Page Content -->
  <div class="container">

        <div class="row">

        <?php
        // $sql = 'select *from class order by no desc';
        // $result = $connect -> query($sql);

        while($row = $result->fetch_assoc()){

          $classNo = $row['no'];
          $query = "select count(*) as cnt from payment_list where num = '$classNo'";
          $res = $connect->query($query);
          $ro = $res->fetch_assoc();

          $peoples = $row['peoples'];
          $cnt_p = $ro['cnt'];

          $remainder = $peoples-$cnt_p;

           ?>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="detail.php?no=<?php echo $row['no']?>"><img class="card-img-top"
              src="images/<?=$row['image']?>" alt="" method="get"></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="detail.php?no=<?php echo $row['no']?>"><?php if($remainder<=2 && $remainder!=0){ echo $row['title']; ?> <span style="color:red">-마감임박</span> <?php
                  } else {echo $row['title'];} ?></a>
                </h4>
              </div>
            </div>
          </div>
        <?php } ?>

        </div>
        <!-- /.row -->

  </div>
  <!-- /.container -->

  <div class = "paging" align=center>
  <?php echo $paging ?>
  </div>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">모든 컨텐츠의 저작권은 디노마드(www.dnomade.com) & 소속 작가에 있습니다.</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>


  </body>

</html>
