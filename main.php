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
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>
        D.NMD
      </title>
      <!-- Bootstrap core CSS -->
      <link href="./css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="./css/shop-homepage.css" rel="stylesheet">
      <style type="text/css">
      <!--
        A:link {text-decoration:none; color:black;}
        A:visited {text-decoration:none; color:black;}
        A:hover {text-decoration:none; color:red;}
      -->
      ul{list-style: none; display: table; padding: 0;}
      li {float: left; margin-right: 5px; margin-left: 5px;}


      </style>
  </head>

  <body>

    <h1><div style="text-align:center"><strong>D.NMD</strong></div></h1>
    <p>
      <div style="text-align:center">"아날로그적 지식과 경험을 공유하다"</div>
    </p>
    <p>
      <div style="text-align:center">디노마드학교는 디자인 및 문화예술 분야의 지식과 경험을 공유하는 장입니다. </br>
      이를 통해 학교와 직장의 울타리를 벗어난 창조적 커뮤니케이션을 지향합니다.</div>
    </p>

    <!-- <a href="login.php">
      <div style="text-align:right">로그인/회원가입</div></a>
    <a href="join.php">문의하기</a></br> -->

  </table>

  <!-- Page Content -->
  <div class="container">

    <div class="row">
      <?php
        if(!isset($_SESSION['ses_userid'])){
          echo "<p>로그인을 해주세요.<a href=\"login.php\"> [로그인/회원가입]</a><a href=\"write.php\"> [1:1 문의하기]</a></p>";
        } else {

          if($_SESSION['ses_userid'] == 'admin'){

            $ses_userid=$_SESSION['ses_userid'];

            echo "<p><strong>관리자</strong> 님 로그인되었습니다.";
            echo "<a href=\"logout.php\">[로그아웃]</a><a href=\"admin.php\"> [관리페이지]</a>";

          } else {
          $ses_userid=$_SESSION['ses_userid'];

          $name_sql = "select *from member where memberId = '$ses_userid'";
          $name_res = $connect -> query($name_sql);
          $name_row = $name_res -> fetch_assoc();

          $name = $name_row['name'];

          echo "<p><strong>$name</strong> 님 환영합니다.";
          echo "<a href=\"logout.php\">[로그아웃]</a><a href=\"write.php\"> [1:1 문의하기]</a>";
          echo "<a href=\"my.php\"> [나의 디노마드]</a></p>";
        } }
       ?>
       </br>
       </br>

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
  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>


  </body>

</html>
