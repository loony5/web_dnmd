<?php
   session_start();
   include "include/connect.php";

   $no = $_GET['no'];
   $sql = "SELECT * FROM board WHERE no=$no";
   $row = mysqli_fetch_assoc($connect->query($sql));

   if(!isset($_SESSION['ses_userid']) || $_SESSION['ses_userid'] != $row['memberId']){

    ?>
    <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo "index.php"?>");
    </script>
    <?php
  
  } 
   
?>

<!-- 삭제 확인 창 -->
<script>
    var check;
    check = confirm("문의글을 정말 삭제하시겠습니까?");

    if(check == true) {

        location.href="inquiry_delete_update.php?no=<?php echo $no?>";
    } else {

        history.go(-1);
    }
</script>
