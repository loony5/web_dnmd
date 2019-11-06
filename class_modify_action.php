<?php

  session_start();
  include "include/connect.php";

  // 관리자 로그인이 아닐 경우 경고창
  if(!isset($_SESSION['ses_userid']) || $_SESSION['ses_userid'] != 'admin') {

    ?>

    <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo "main.php"?>");
    </script>

    <?php
  }
  

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

  // 빈칸이 있을 경우,
  if($title == '' || $teacher == '' || $date == '' || $time == '' || $place == '' ||
  $peoples == '' || $charge == '' || $content == '') {

    ?>

    <script>
    alert("<?php echo "모두 바르게 입력해주세요."?>");
    history.go(-1);
    </script>

  <?php } else {

    // 이미지 수정없이 나머지 부분을 수정했을 경우,
    if($image == '') {

      $sql = "UPDATE class SET title='$title', teacher='$teacher', date='$date',
      time='$time', place='$place', peoples='$peoples', charge='$charge', content='$content'
      WHERE no='$no'";

      if($connect->query($sql)) {

        ?>

        <script>
        alert("수업이 수정되었습니다.");
        location.replace("<?php echo 'admin.php'?>");
        </script>

      <?php } else {

        ?>

        <script>
        alert("업로드에 실패했습니다.");
        history.go(-1);
        </script>
      <?php }

    // 새로운 이미지로 수정했을 경우,
    } else {

      $sql = "UPDATE class SET title='$title', teacher='$teacher', date='$date',
      time='$time', place='$place', peoples='$peoples', charge='$charge', content='$content',
      image='$image' WHERE no='$no'";

      if($connect->query($sql)) {

        // 새로운 이미지 업로드
        move_uploaded_file($_FILES['image']['tmp_name'], "images/$image");

        ?>

        <script>
        alert("수업이 수정되었습니다.");
        location.replace("<?php echo "admin.php"?>");
        </script>
      <?php } else {

        ?>

        <script>
        alert("업로드에 실패했습니다.");
        history.go(-1);
        </script>

      <?php }
    }
  }

?>
