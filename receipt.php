
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
      <li rold="presentation" class="active"><a href="receipt.php">신청내역</a></li>
      <li rold="presentation"><a href="my_inquiry.php">1:1 문의내역</a></li>
    </ul>

    <div class="table-responsive" style="margin-top:15px">
      <table class="table table-bordered">
        <thead>
          <tr>
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

            $sql = "SELECT *FROM payment_list WHERE memberId='$memberId' ORDER BY NO DESC";
            $result = $connect->query($sql);

            while ($row = $result->fetch_assoc()) { ?>

          <tr>
            <td><img class="img-rounded" width="50px" src="images/<?php echo $row['image']?>">
              <a href = "class_detail.php?no=<?php echo $row['num']?>"><?php echo $row['title']; ?>
            </td>
            <td style="text-align: center"><p><?php echo $row['date']?></p></td>
            <td style="text-align: center"><p><?php echo $row['time']?></p></td>
            <td style="text-align: center"><p><?php echo $row['charge']?></p></td>
            <td style="text-align: center"><p>결제완료</p></td>
          </tr>

          <?php } ?>

        </tbody>
      </table>
    </div>
  </div>

  <?php include 'view/bottom_view.php'; ?>

</body>

</html>
