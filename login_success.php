<?php
    session_start();
    include "../dnmd/include/connect.php";
    // ini_set('display_errors', true);

    $memberId = $_POST['memberId'];
    $memberPw = md5($memberPw = $_POST['memberPw']);

    if(!isset($_SESSION['ses_userid'])){

    if($_POST['memberId'] == '' || $_POST['memberPw'] == ''){ ?>

      <script>
      alert("입력이 바르지 않습니다.");
      history.go(-1);
      </script>

    <?php } else {


    $sql = "SELECT * FROM member WHERE memberId = '{$memberId}' AND password = '{$memberPw}'";
    $res = $connect->query($sql);
    $row = $res->fetch_array(MYSQLI_ASSOC);


    if ($row == null) {

      if(isset($_COOKIE["member_login"])){

        setcookie("member_login", "");
        header("Content-Type: text/html; charset=utf-8");
        echo "<script>alert('아이디 또는 비밀번호가 잘못되었습니다.');";
        echo "window.location.replace('login.php');</script>";
        exit;

      } else {

        header("Content-Type: text/html; charset=utf-8");
        echo "<script>alert('아이디 또는 비밀번호가 잘못되었습니다.');";
        echo "window.location.replace('login.php');</script>";
        exit;
      }

    } else {

      if(!empty($_POST['idSaveCheck'])){

      setcookie("member_login", $_POST['memberId'], time()+(10 * 355 * 24 * 60 * 60));
      $_SESSION['ses_userid'] = $row['memberId']; ?>
      <meta http-equiv="refresh" content="0;url=main.php"/>

    <?php } else {

      setcookie("member_login", "");
      $_SESSION['ses_userid'] = $row['memberId']; ?>
      <meta http-equiv="refresh" content="0;url=main.php"/>

    <?php } } } } else {

      $ses_userid=$_SESSION['ses_userid'];
      echo "<p><strong>$ses_userid</strong> 님은 이미 로그인하고 있습니다.";
      echo "<a href=\"main.php\">[돌아가기]</a>";
      echo "<a href=\"logout.php\">[로그아웃]</a></p>";

    }?>
