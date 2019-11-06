
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
  </style>
</head>

<body>

  <?php include 'top_view.php'?>

  <div class="container">
    <h2 class="text-center" style="margin-top:30px; margin-bottom:50px">나의 디노마드</h2>

    <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="cart.php">담아둔 수업</a></li>
      <li rold="presentation"><a href="receipt.php">신청내역</a></li>
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
            <th></th>
          </tr>
        </thead>

        <tbody>
        <?php
            $memberId = $_SESSION['ses_userid'];

            $sql = "SELECT *FROM cart WHERE memberId='$memberId' ORDER BY NO DESC";
            $result = $connect->query($sql);

            while ($row = $result->fetch_assoc()) {

                $classNo = $row['num'];

                $class_sql = "SELECT * FROM class WHERE no = '$classNo'";
                $class_row = mysqli_fetch_assoc($connect->query($class_sql));


                $pay_sql = "SELECT count(*) as cnt FROM payment_list WHERE num = '$classNo'";
                $pay_row = mysqli_fetch_assoc($connect->query($pay_sql));

                $remainder = $class_row['peoples'] - $pay_row['cnt'];

        ?>
          <tr>
            <td><img class="img-rounded" width="50px" src="images/<?php echo $row['image']?>">
              <a href = "class_detail.php?no=<?php echo $row['num']?>">
              <?php if($remainder<=2 && $remainder!=0){ echo $row['title']; ?>
              <span style="color:red">-마감임박</span> <?php } else { 
                echo $row['title'];} ?>
            </td>
            <td style="text-align: center"><p><?php echo $row['date']?></p></td>
            <td style="text-align: center"><p><?php echo $row['time']?></p></td>
            <td style="text-align: center"><p><?php echo $row['charge']?></p></td>
            <td style="text-align: center">
              <input class="btn btn-default" type="button" name="payment_btn" value="참여하기" onclick="location.href='payment.php?no=<?php echo $row['num']?>'">
              <input class="btn btn-default" type="button" name="delete_btn" value="삭제" onclick="location.href='cart_delete.php?no=<?php echo $row['no']?>'">
            </td>
              
          </tr>

          <?php } ?>

        </tbody>
      </table>
    </div>

    <div class="col-md-4"></div>

    <div class="col-md-4" style="margin-top:20px; margin-bottom:20px">
        <button class="btn btn-lg btn-info btn-block" type="button" onclick="location.href='main.php'">계속 둘러보기</button>
    </div>

  </div>

</body>

</html>
