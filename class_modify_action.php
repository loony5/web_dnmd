<?
  include "../dnmd/include/connect.php";

  $no = $_POST['no'];

  $title = $_POST['title'];
  $teacher = $_POST['teacher'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $place = $_POST['place'];
  $peoples = $_POST['peoples'];
  $charge = $_POST['charge'];
  $content = $_POST['content'];

  $image = $_FILES['image']['name'];

  if($title == '' || $teacher == '' || $date == '' || $time == '' ||
  $place == '' || $peoples == '' || $charge == '' || $content == ''){

    ?>

    <script>
    alert("<?php echo "모두 바르게 입력해주세요."?>");
    history.go(-1);
    </script>

    <?php
  } else {

    if ($image == ''){

      $sql = "update class set title='$title', teacher='$teacher', date='$date',
      time='$time', place='$place', peoples='$peoples', charge='$charge',
      content='$content' where no='$no'";

      $result = $connect->query($sql);

      if($result){
        ?>
        <script>
        alert("수업이 수정되었습니다.");
        location.replace("<?php echo '../dnmd/admin.php'?>");
        </script>
      <?php } else {

        echo "error";
      }

    } else {
      $sql = "update class set title='$title', teacher='$teacher', date='$date',
      time='$time', place='$place', peoples='$peoples', charge='$charge',
      content='$content', image='$image' where no ='$no'";

      $result = $connect->query($sql);

      if($result){

        move_uploaded_file($_FILES['image']['tmp_name'], "images/$image");

        ?>
        <script>
        alert("수업이 수정되었습니다.");
        location.replace("<?php echo '../dnmd/admin.php'?>");
        </script>
    <?php }
  }

  mysqli_close($connect);
} ?>
