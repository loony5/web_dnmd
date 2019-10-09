<?
//데이터 베이스 연결하기
  include "../dnmd/include/connect.php";

  session_start();

  $no = $_POST['no'];
  $password = $_POST['password'];
  $pw = md5($password);
  $ses_userid=$_SESSION['ses_userid'];

  $sql = "select *from board where no=$no and memberId='$ses_userid'";
  $result = $connect->query($sql);
  $row = $result->fetch_assoc();

  $query = "select *from member where memberId='$ses_userid'";
  $res = $connect->query($query);
  $rows = $res->fetch_assoc();



  if ($pw==$rows['password'] )//비밀번호 맞는지 확인함.
  {
      $sq = "delete from board where no=$no"; //데이터 삭제하는 쿼리문
      $re = $connect->query($sq);

  ?>
      <script>
        alert("<?php echo "글이 삭제되었습니다."?>");
        location.replace("<?php echo '../dnmd/my_inquiry.php'?>");
      </script>

  <?php } else { ?>

      <script>
      alert('비밀번호가 틀립니다.');
      history.go(-1);
      </script>

  <?php }

?>
