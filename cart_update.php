<?php
  include 'include/connect.php';
  session_start();

  $no = $_GET['no'];
  $sql = "SELECT * FROM class WHERE no = $no";
  $row=mysqli_fetch_assoc($connect->query($sql));

  $memberId = $_SESSION['ses_userid'];
  $title = $row['title'];
  $date = $row['date'];
  $time = $row['time'];
  $charge = $row['charge'];
  $image = $row['image'];

  $query = "INSERT INTO cart (no, num, memberId, title, date, time, charge, image)
            VALUES(null, '$no', '$memberId', '$title', '$date', '$time', '$charge', '$image')";

  $result = $connect->query($query);

  if($result){

    ?>

    <script>
    alert("<?php echo "수업이 담아두기로 등록되었습니다."?>");
    location.replace("<?php echo "cart.php"?>");
    </script>

  <?php mysqli_close($connect);
} else {

  echo "FAIL";
}

 ?>
