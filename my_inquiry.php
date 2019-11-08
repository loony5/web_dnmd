
<!DOCTYPE html>
<?php
  session_start();
  include "include/connect.php";

  if(!isset($_SESSION['ses_userid'])){

     ?>
     <script>
      alert("로그인이 필요합니다.");
      location.replace("<?php echo "login.php"?>");
    </script>
    <?php
  } ?>

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
    <h2 class="text-center" style="margin-top:30px; margin-bottom:50px">나의 디노마드</h2>

    <ul class="nav nav-tabs">
      <li role="presentation"><a href="cart.php">담아둔 수업</a></li>
      <li rold="presentation"><a href="receipt.php">신청내역</a></li>
      <li rold="presentation" class="active"><a href="my_inquiry.php">1:1 문의내역</a></li>
    </ul>

    <div class="table-responsive" style="margin-top:15px">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>작성일</th>
            <th>제목</th>
            <th>문의상태</th>
          </tr>
        </thead>

        <tbody>
        <?php
            $memberId = $_SESSION['ses_userid'];

            $sql = "SELECT * FROM board WHERE memberId='$memberId' ORDER BY NO DESC";
            $result = $connect->query($sql);

            while ($row = $result->fetch_assoc()) {

                $datetime = explode(' ', $row['date']);
                $date = $datetime[0];
                $time = $datetime[1];

                $num = $row['no'];

                if($date == Date('Y-m-d')) {
                $row['date'] = $time;
                } else {
                $row['date'] = $date;
                } ?>

          <tr>
            <td style="text-align: center"><p><?php echo $row['date']?></p></td>
            <td><a href = "inquiry_view.php?no=<?php echo $row['no']?>">
                <?php echo $row['title'] ?></a>
            </td>
            <td style="text-align: center">
                <?php
                    $sql = "SELECT *FROM comment WHERE num = '$num'";
                    $row = mysqli_fetch_assoc($connect->query($sql));

                    if(isset($row)){

                        echo "답변 완료";
                    } else {

                        echo "진행중";
                    } ?>
            </td>
          </tr>

          <?php } ?>

        </tbody>
      </table>
    </div>

    <div class="col-md-4"></div>

    <div class="col-md-4" style="margin-top:20px; margin-bottom:20px">
        <a class="btn btn-lg btn-info btn-block" href="inquiry_write.php">1:1 문의하기</a>
    </div>
    
  </div>

  <?php include 'view/bottom_view.php'; ?>

</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>

</html>
