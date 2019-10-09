<!DOCTYPE html>
<?php
    session_start();
    include "../dnmd/include/connect.php"; ?>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>D.NMD</title>
    <style type="text/css">
    table {margin: auto;}
    </style>
  </head>

  <body>
    <h1><div style="text-align:center">D.NMD</div></h1>
    <h4><div style="text-align:center">로그인</div></h4>
    <?php if(!isset($_SESSION['ses_userid'])) { ?>
      <form method="post" action="login_success.php">
        <table>
          <tr>
            <td>아이디</td>
            <td><input type="text" name="memberId" class="memberId"
              value="<?php if(isset($_COOKIE['member_login'])) {echo $_COOKIE["member_login"];} ?>"/></td>
          </tr>
          <tr>
            <td>비밀번호</td>
            <td><input type="password" name="memberPw" class="memberPw"/></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="checkbox" name="idSaveCheck" <?php if(isset($_COOKIE["member_login"])){ ?> checked <?php } ?>/>아이디 기억하기</td>
          </tr>
            <td></td>
            <td><input type="submit" value="로그인"/>
            <input type="button" name="join" value="회원가입" onclick="location.href='join.php';"></td>
        </table>
      </form>
    <?php } else {
      $ses_userid=$_SESSION['ses_userid'];
      echo "<p><strong>$ses_userid</strong> 님은 이미 로그인하고 있습니다.";
      echo "<a href=\"main.php\">[돌아가기]</a>";
      echo "<a href=\"logout.php\">[로그아웃]</a></p>";
    } ?>


    <!-- <form name="login" action="main.php" method="post" onsubmit="return checkSubmit()">
      <table>
        <tr>
          <td>아이디</td>
          <td><input type="text" name="memberId" value="" placeholder="id" class="memberId"/></td>
        </tr>
        <tr>
          <td>비밀번호</td>
          <td><input type="password" name="memberPw" placeholder="password" class="memberPw"/></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="login" value="로그인" class="submit"/>
          <input type="button" name="join" value="회원가입" onclick="location.href='join.php';"></td>
        </tr>
    </table>
    </form> -->
  </body>
</html>
