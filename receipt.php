
<!DOCTYPE html>
<?php
  session_start();
  include "../dnmd/include/connect.php";

  if(!isset($_SESSION['ses_userid'])){

     ?>
     <script>
      alert("로그인이 필요합니다.");
      location.replace("<?php echo "./login.php"?>");
    </script>
    <?php
  } ?>

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
  </style>


</head>

<body id="page-top">

  <h1><div style="text-align:center"><a href="../dnmd/main.php">D.NMD</a></div></h1>
  <h4><div style="text-align:center">나의 디노마드</div></h4>



      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="../dnmd/my.php">[담아두기]</a>
            <a href="../dnmd/receipt.php">[신청내역]</a>
            <a href="../dnmd/my_inquiry.php">[문의내역]</a>
          </li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>신청내역</div>
          <div class="card-body">
            <div class="table-responsive">
              <form name = "form" method="get">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <!-- <th>선택</th> -->
                    <th>수업정보</th>
                    <th>일자</th>
                    <th>시간</th>
                    <th>수업료</th>
                    <th>결제상태</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                    $memberId = $_SESSION['ses_userid'];

                    $sql = "select *from payment_list where memberId='$memberId' order by no desc";
                    $result = $connect->query($sql);

                    while ($row = $result->fetch_assoc()) { ?>

                      <tr>
                        <td><img class="img-fluid rounded" width="100px" src="images/<?php echo $row['image']?>">
                          <a href = "detail.php?no=<?php echo $row['num']?>"><?php echo $row['title']?></td>
                        <td><?php echo $row['date']?></td>
                        <td><?php echo $row['time']?></td>
                        <td><?php echo number_format($row['charge'])?>원</td>
                        <td>결제완료</td>

                      </tr>

                    <?php } ?>


                  <!-- <tr>
                    <td colspan="6" align="center">합계 : <input name="total_sum" type="text" style="width:100px; text-align:right;" readonly>원</td>

                  </tr> -->

                </tbody>

              </table>
            </form>
            </div>
          </div>
        </div>

</body>

</html>
