<?php
  include "../dnmd/include/connect.php";

  $no = $_POST['no'];

  $title = $_POST['title'];
  $content = $_POST['content'];

  if($title == '' || $content == ''){

    ?>

    <script>
      alert("<?php echo "제목과 내용을 입력해주세요."?>");
      history.go(-1);
    </script>

  <?php } else {

  $sql = "update board set title='$title', content='$content' where no = '$no'";

  $result = $connect->query($sql);

  if($result){

  ?>

  <script>
    alert("<?php echo "글이 수정되었습니다."?>");
    location.replace("<?php echo '../dnmd/my_inquiry.php'?>");
  </script>

  <?php
  } else {
    echo "FAIL";
  }

  mysqli_close($connect);
  }
  ?>
