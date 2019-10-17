
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

      $paging .= '<li class="page"><a href="./admin.php?page=' . $i . '">' . $i . '</a></li>';

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

  <script language="javascript">

  function itemSum(frm){
    var sum = 0;
    var count = frm.checkbox.length;
    for(var i=0; i<count; i++){
      if(frm.checkbox[i].checked == true){
        sum += parseInt(frm.checkbox[i].value);
      }
    }
    frm.total_sum.value = sum;
  }

  // $( document ).ready( function() {
  //       $( '.select' ).click( function() {
  //         $( '.checkbox' ).prop( 'checked', this.checked );
  //
  //       } );
  //     } );

  </script>

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
            <i class="fas fa-table"></i><a href="../dnmd/admin.php">[진행중] </a><a href="../dnmd/past.php">[마감]</a></div>
          <div class="card-body">
            <div class="table-responsive">
              <form name = "form" method="get">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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

                    // $sql = "select *from class order by no desc";
                    // $result = $connect->query($sql);

                    while ($row = $result->fetch_assoc()) {

                      $classNo = $row['no'];
                      $query = "select count(*) as cnt from payment_list where num = '$classNo'";
                      $res = $connect->query($query);
                      $ro = $res->fetch_assoc();

                      $peoples = $row['peoples'];
                      $cnt_p = $ro['cnt'];
                      $remainder = $peoples-$cnt_p;

                      ?>

                      <tr>
                        <td><?php echo $row['no']?></td>
                        <td><img class="img-fluid rounded" width="100px" src="images/<?php echo $row['image']?>"></td>
                        <td><a href = "detail.php?no=<?php echo $row['no']?>">
                          <?php echo $row['title']?>
                        </td>
                        <td><?php echo $row['teacher']?></td>
                        <td><?php echo $row['date']?></td>
                        <td><?php echo $row['time']?></td>
                        <td><?php echo $row['peoples']?></td>
                        <td><?php if($peoples == $cnt_p){?>

                          <span style="color:red">마감</span>

                        <?php } else if($remainder<=2 && $remainder!=0){ echo $ro['cnt']; ?> </br><span style="color:red">마감임박</span> <?php
                        } else {echo $ro['cnt'];} ?></td>
                        <td><?php echo number_format($row['charge'])?>원</td>
                        <td><input type="hidden" name="no" value="<?php echo $row['no']?>">

                          <input type="button" name="delete_btn" value="수정"
                          onclick="location.href='./class_modify.php?no=<?php echo $row['no']?>'">

                          <input type="button" name="delete_btn" value="삭제"
                          onclick="location.href='./delete_check.php?no=<?php echo $row['no']?>'"></td>

                      </tr>

                    <?php } ?>

                </tbody>

              </table>
            </form>
            </div>
          </div>
        </div>
        <div class="row mb-4">

          <div class="col-md-4">
            <a class="btn btn-lg btn-secondary btn-block" href="./register.php">수업등록</a>
          </div>
      </div>
      <!-- /.container-fluid -->

      <div class = "paging" align=center>
      <?php echo $paging ?>
      </div>

</body>

</html>
