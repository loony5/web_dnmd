<!DOCTYPE html>
<?php
    session_start();
    include "../dnmd/include/connect.php"; ?>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width", initial-scale="1">
    <title>D.NMD</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/signin.css">

    <style>
      body {
        padding-top: 60px;
        padding-bottom: 60px;
      }
    </style>
  </head>

  <body>

  <!-- 세션에 아이디가 없을 때, -->
  <?php if(!isset($_SESSION['ses_userid'])) { ?>
    <div class="container">

      <form class="form-signin" method="post" action="login_success.php">
        <h2 class="form-signin-heading">D.NMD</h2>

        <input type="text" name="memberId" class="form-control" placeholder="아이디" required autofocus
        value="<?php if(isset($_COOKIE['member_login'])) { echo $_COOKIE['member_login']; } ?>">
        
        <input type="password" name="memberPw" class="form-control" placeholder="비밀번호" required>
        
        <div class="checkbox">
          <label>
            <input type="checkbox" name="idSaveCheck"
            <?php if(isset($_COOKIE['member_login'])) { ?> checked <?php } ?>> 아이디 기억하기
          </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">로그인</button>
        <button class="btn btn-lg btn-info btn-block" type="button" onclick="location.href='join.php'">회원가입</button>
      </form>

    </div>

    <!-- 이미 로그인한 세션 아이디가 있을 때, -->
  <?php } else {

    $ses_userid = $_SESSION['ses_userid'];

    ?>

    <div class="container">
      <h2 class="form-signin-heading text-center"><?php echo "$ses_userid"; ?> 님은 이미 로그인되어 있습니다.</h2>

      <form class="form-signin">
        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="location.href='main.php'">돌아가기</button>
        <button class="btn btn-lg btn-info btn-block" type="button" onclick="location.href='logout.php'">로그아웃</button>
      </form>
    </div>


  <?php } ?>

  </body>
</html>
