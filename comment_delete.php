<?

  include "../dnmd/include/connect.php";

  session_start();

  $no = $_GET['no'];

  if($_SESSION['ses_userid'] == 'admin'){

    $sql = "delete from comment where num='$no'";
    $result = $connect -> query($sql);
    ?>

    <script>
    alert("<?php echo "답변이 삭제되었습니다."?>");
    location.replace("<?php echo "../dnmd/view.php?no=$no"?>");
    </script>

  <?php } else {

    ?>

    <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo "../dnmd/view.php?no=$no"?>");
    </script>

  <?php }
?>
