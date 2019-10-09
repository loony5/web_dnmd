<?php
  include '../dnmd/include/connect.php';
  session_start();

  $no = $_GET['no'];
  $sql = "select * from class where no = $no";
  $result = $connect->query($sql);
  $row=mysqli_fetch_assoc($result);

  $memberId = $_SESSION['ses_userid'];
  $title = $row['title'];
  $date = $row['date'];
  $time = $row['time'];
  $charge = $row['charge'];
  $image = $row['image'];

  $query = "insert into cart (no, num, memberId, title, date, time, charge, image)
            value(null, '$no', '$memberId', '$title', '$date', '$time', '$charge', '$image')";

  $res = $connect->query($query);

  if($res){

    ?>

    <script>
    alert("<?php echo "수업이 담아두기로 등록되었습니다."?>");
    location.replace("<?php echo "../dnmd/my.php"?>");
    </script>

  <?php mysqli_close($connect);
} else {

  echo "FAIL";
}

 ?>
