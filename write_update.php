<?php
  include "../dnmd/include/connect.php";

  $memberId = $_POST[memberId];
  $title = $_POST[title];
  $content = $_POST[content];
  $date = date('Y-m-d H:i:s');

  $URL = '../dnmd/my_inquiry.php';

  if($title == '' || $content == ''){

  ?>
    <script>
      alert("<?php echo "제목과 내용을 입력해주세요."?>");
      history.go(-1);
    </script>

  <?php } else {

  $sql = "insert into board (no, title, content, date, memberId)
          values(null, '$title', '$content', '$date', '$memberId')";

  $result = $connect->query($sql);

  if($result){

 ?>

  <script>
    alert("<?php echo "글이 등록되었습니다."?>");
    location.replace("<?php echo $URL?>");
  </script>

  <?php mysqli_close($connect);
  } else {
    echo "FAIL";
  } ?>
  <?php }
  ?>
