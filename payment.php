
<!DOCTYPE html>
<?php
  session_start();
  include "../dnmd/include/connect.php";

  $no = $_GET['no'];

  $memberId = $_SESSION['ses_userid'];

  $sql = "select *from cart where no='$no'";
  $result = $connect->query($sql);
  $row = $result->fetch_assoc();

  if(!isset($_SESSION['ses_userid'])){

     ?>
     <script>
      alert("로그인이 필요합니다.");
      location.replace("<?php echo "./login.php"?>");
    </script>
    <?php
  }

  if($no == ''){ ?>

    <script>
     alert("선택한 수업이 없습니다.");
     location.replace("<?php echo "./main.php"?>");
   </script>

  <?php }?>

<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- <script src="//code.jquery.com/jquery-3.3.1.min.js"></script> -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
  <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>

  <script>
  $(function(){
  var payment = $('.payment');

  payment.click(function(){

        var IMP = window.IMP;
        IMP.init('imp41319736');

        IMP.request_pay({
    pg : 'inicis', // version 1.1.0부터 지원.
    pay_method : 'card',
    merchant_uid : 'merchant_' + new Date().getTime(),
    name : '<?php echo $row['title']?>',
    amount : '<?php echo $row['charge']?>',
    buyer_email : '',
    buyer_name : 'D.NMD',
    buyer_tel : '010-1234-5678',
    buyer_addr : '',
    buyer_postcode : '',
    m_redirect_url : ''
}, function(rsp) {
    if ( rsp.success ) {
        var msg = '결제가 완료되었습니다.';
        // msg += '고유ID : ' + rsp.imp_uid;
        // msg += '상점 거래ID : ' + rsp.merchant_uid;
        msg += '결제 금액 : ' + rsp.paid_amount;
        // msg += '카드 승인번호 : ' + rsp.apply_num;

        alert(msg);
        location.href="pay_success.php?no=<?php echo $row['no']?>";

    } else {
        var msg = '결제에 실패하였습니다.';
        msg += '에러내용 : ' + rsp.error_msg;
        alert(msg);
    }

});

  });

});

  </script>

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

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>결제하기</div>
          <div class="card-body">
            <div class="table-responsive">
              <form name = "form" method="get">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>수업정보</th>
                    <th>일자</th>
                    <th>시간</th>
                    <th>수업료</th>
                  </tr>
                </thead>

                <tbody>

                    <tr>

                      <td><img class="img-fluid rounded" width="100px" src="images/<?php echo $row['image']?>">
                        <a href = "detail.php?no=<?php echo $row['num']?>"><?php echo $row['title']?></td>
                      <td><?php echo $row['date']?></td>
                      <td><?php echo $row['time']?></td>
                      <td><?php echo number_format($row['charge'])?>원</td>

                    </tr>

                </tbody>

              </table>
            </form>
            </div>
          </div>
        </div>


        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>주문자 정보</div>
          <div class="card-body">
            <div class="table-responsive">
              <form name = "form" method="get">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>주문자명</th>
                    <th>연락처</th>
                    <th>이메일</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                    $memberId = $_SESSION['ses_userid'];

                    $query = "select *from member where memberId='$memberId'";
                    $result = $connect->query($query);
                    $row = $result->fetch_assoc(); ?>

                    <tr>
                      <td><?php echo $row['name']?></td>
                      <td><?php echo $row['phone']?></td>
                      <td><?php echo $row['eMail']?></td>
                    </tr>

                </tbody>

              </table>
            </form>
            </div>
          </div>
        </div>



        <div class="row mb-4">

          <div class="col-md-4">
            <input type="button" name="payment" value="결제하기" class="payment">
            <input type="hidden" name="no" value="<?php echo $row['no']?>">
            <input type="hidden" name="m_no" value="<?php echo $row['num']?>">
            <!-- <a class="btn btn-lg btn-secondary btn-block" name="payment">결제하기</a> -->
          </div>

      </div>
      <!-- /.container-fluid -->
    </div>

</body>

</html>
