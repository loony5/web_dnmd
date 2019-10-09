
<!DOCTYPE html>
<?php
  session_start();
  include "../dnmd/include/connect.php";

  if($_SESSION['ses_userid'] != 'admin'){

     ?>
     <script>
      alert("권한이 없습니다.");
      location.replace("<?php echo "./main.php"?>");
    </script>
    <?php
  }

  // paging start
  if(isset($_GET['page'])) {

    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  $sql = 'select count(*) as cnt from board order by no desc';
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

  $paging = '<ul>';

  if($currentSection != 1) {

    $paging .= '<li class="page page_prev"><a href="./inquiry_board.php?page=' . $prevPage . '">이전</a></li>';

  }

  for($i = $firstPage; $i <= $lastPage; $i++) {

    if($i == $page) {

      $paging .= '<li class="page current">' . $i . '</li>';

    } else {

      $paging .= '<li class="page"><a href="./inquiry_board.php?page=' . $i . '">' . $i . '</a></li>';

    }

  }

  //마지막 섹션이 아니라면 다음 버튼을 생성

  if($currentSection != $allSection) {

    $paging .= '<li class="page page_next"><a href="./inquiry_board.php?page=' . $nextPage . '">다음</a></li>';

  }

  $paging .= '</ul>';

  $currentLimit = ($onePage * $page) - $onePage;
  $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage;
  $sql = 'select * from board order by no desc' . $sqlLimit;

  $result = $connect->query($sql);

   ?>

<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>

  <title>D.NMD</title>

  <!-- Page level plugin CSS-->
  <link href="css/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link rel="stylesheet" href="./css/normalize.css"/>
  <link rel="stylesheet" href="./css/board.css"/>

  <style>
  body{width: 70%; margin: auto;}
  ul{list-style: none; display: table; padding: 0;}
  li {float: left; margin-right: 5px; margin-left: 5px;}
  </style>

</head>

<body id="page-top">

  <h1><div style="text-align:center"><a href="../dnmd/main.php">D.NMD</a></div></h1>
  <h4><div style="text-align:center">관리페이지</div></h4>

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="../dnmd/admin.php">[수업 관리]</a>
            <a href="../dnmd/inquiry_board.php">[문의게시판 관리]</a>
          </li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>문의게시판 관리</div>
          <div class="card-body">
            <div class="table-responsive">
              <form name = "form" method="get">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>no</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>작성일</th>
                    <th>답변 상태</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                    $memberId = $_SESSION['ses_userid'];

                    while ($row = $result->fetch_assoc()) {
                      $num = $row['no']; ?>

                      <tr>
                        <td><?php echo $row['no']?></td>
                        <td><a href = "view.php?no=<?php echo $row['no']?>">
                          <?php echo $row['title']?>
                        </td>
                        <td><?php echo $row['memberId']?></td>
                        <td><?php echo $row['date']?></td>
                        <td><?php

                        $quer = "select *from comment where num = '$num'";
                        $re = $connect->query($quer);
                        $roo = $re->fetch_assoc();

                        if(isset($roo)){

                          echo "답변 완료";

                        } else {
                          echo "진행중";
                        }

                        ?></td>

                      </tr>

                    <?php } ?>

                </tbody>

              </table>
            </form>
            </div>
          </div>
        </div>
      <!-- /.container-fluid -->

      <div class = "paging" align=center>
      <?php echo $paging ?>
      </div>

</body>

</html>
