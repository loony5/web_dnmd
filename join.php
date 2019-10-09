<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8"/>
  <title>D.NMD</title>
  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>
  <script type="text/javascript" src="../dnmd/js/join.js?ver=1>"></script>

  <style type="text/css">
  <!--
    A:link {text-decoration:none; color:black;}
    A:visited {text-decoration:none; color:black;}
    A:hover {text-decoration:none; color:red;}
  -->
  a {margin-right:10px;}
  table {margin: auto;}
  </style>

</head>

<body>
  <h1><div style="text-align:center">D.NMD</div></h1>
  <h4><div style="text-align:center">회원가입</div></h4>

  <form name="form name" action="../dnmd/success.php" method="post" onsubmit="return checkSubmit()">
    <table>

      <tr>
        <td>아이디</td>
        <td><input type="text" name="memberId" value="" placeholder="id" class="memberId"/></td>
        <td><input type="button" name="memberIdCheck" value="중복확인" class="memberIdCheck"></td>
      </tr>

      <tr>
        <td>이름</td>
        <td><input type="text" name="memberName" value="" placeholder="name" class="memberName"/></td>
      </tr>

      <tr>
        <td>비밀번호</td>
        <td><input type="password" name="memberPw" placeholder="password" class="memberPw"/></td>
      </tr>

      <tr>
        <td>비밀번호 확인</td>
        <td><input type="password" name="memberPw2" placeholder="confirm password" class="memberPw2"/></td>
        <td><div class="memberPw2Comment comment"></div></td>
      </tr>

      <tr>
        <td>이메일</td>
        <td><input type="text" name="memberEmail" value="" placeholder="email" class="memberEmail"/></td>
        <td><div class="memberEmailComment comment"></div></td>
      </tr>

      <tr>
        <td>연락처</td>
        <td><input type="text" name="memberPhone" value="" placeholder="phone number" class="memberPhone"/></td>
        <td><div class="memberPhoneComment comment"></div></td>
      </tr>

      <tr>
        <td></td>
        <td><input type="submit" name="submit" value="가입하기" class="submit"></td>
      </tr>

      <input type="hidden" name="pwCheck2" class="pwCheck2"/>
      <input type="hidden" name="emailCheck" class="emailCheck"/>
      <input type="hidden" name="phoneCheck" class="phoneCheck"/>

    </table>
  </form>
</body>
</html>
