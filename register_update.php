<?php
  include 'include/connect.php';

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
    $place == '' || $peoples == '' || $charge == '' || $content == '' || $image == ''){

      ?>

      <script>
      alert("<?php echo "모두 바르게 입력해주세요."?>");
      history.go(-1);
      </script>

    <?php } else {

      $sql = "INSERT INTO class (no, title, teacher, date, time, place, peoples, charge, content, image)
      VALUES(null, '$title', '$teacher', '$date', '$time', '$place', '$peoples', '$charge', '$content', '$image')";

      $result = $connect->query($sql);

      if($result){

        move_uploaded_file($_FILES['image']['tmp_name'], "images/$image");

        ?>
        <script>
        alert("수업이 등록되었습니다.");
        location.href="admin.php";
        </script>

      <?php } else {

      ?>
      <script>
      alert("수업등록을 실패했습니다.");
      location.href="main.php";
      </script>
    <?php }}

   ?>
