<?php
  include '../dnmd/include/connect.php';

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

      if($image == ''){

        $f_sql = "select *from past where teacher = '$teacher'";
        $f_result = $connect -> query($f_sql);
        $f_row = $f_result -> fetch_assoc();

        $f_image = $f_row['image'];

        $sql = "insert into class (no, title, teacher, date, time, place, peoples, charge, content, image)
        values(null, '$title', '$teacher', '$date', '$time', '$place', '$peoples', '$charge', '$content', '$f_image')";

        $result = $connect->query($sql);

        if($result){

          move_uploaded_file($_FILES['image']['tmp_name'], "images/$f_image");

          ?>
          <script>
          alert("수업이 재등록되었습니다.");
          location.href="../dnmd/admin.php";
          </script>

        <?php } else {

        ?>
        <script>
        alert("수업등록을 실패했습니다.");
        location.href="../dnmd/main.php";
        </script>
      <?php }} else {

        $sql = "insert into class (no, title, teacher, date, time, place, peoples, charge, content, image)
        values(null, '$title', '$teacher', '$date', '$time', '$place', '$peoples', '$charge', '$content', '$image')";

        $result = $connect->query($sql);

        if($result){

          move_uploaded_file($_FILES['image']['tmp_name'], "images/$image");

          ?>
          <script>
          alert("수업이 재등록되었습니다.");
          location.href="../dnmd/admin.php";
          </script>

        <?php } else {

        ?>
        <script>
        alert("수업등록을 실패했습니다.");
        location.href="../dnmd/main.php";
        </script>
      <?php }

    }}

     ?>
