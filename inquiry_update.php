<?php
  include "include/connect.php";

  $memberId = $_POST['memberId'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $date = date('Y-m-d H:i:s');
  $name = $_POST['name'];


  if($title == '' || $content == ''){

  ?>
    <script>
      alert("<?php echo '제목과 내용을 입력해주세요.' ?>");
      history.go(-1);
    </script>

  <?php } else {

    $sql = "INSERT INTO board (no, title, content, memberId, name, date) 
            VALUES (null, '$title', '$content', '$memberId', '$name', '$date')";

    $result = $connect->query($sql);

    if($result){

  ?>
      <script>
        alert("<?php echo "글이 등록되었습니다."?>");
        location.replace("<?php echo 'my_inquiry.php'?>");
      </script>

      <?php mysqli_close($connect);

      echo $date;

    } else {
      echo 'Fail' . $name;

    } 
    
  } ?>
