<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width", initial-scale="1">
  <title>D.NMD</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/signin.css">

  <style>

    body {
    padding-top: 60px;
    padding-bottom: 60px;
    }

  a {margin-right:10px;}
  table {margin: auto;}
  </style>

</head>

<body>

  <div class="container">
    <div class="row">

      <div class="col-md-3">
      </div>

      <div class="col-md-6">

        <form action="success.php" method="post">
          <h2 class="form-signin-heading" style="margin-bottom:20px">D.NMD</h2>
          
          <label for="memberId">아이디</label>
          <div class="input-group input-group-lg" style="margin-bottom:15px">
            <input id="memberId" class="form-control" type="text" name="memberId" value="" placeholder="User ID" required autofocus>
            <span class="input-group-btn">
            <button id="memberIdCheck" class="btn btn-default" type="button" name="memberIdCheck">중복확인</button>
            </span>
          </div>

          <div class="form-group">
            <label for="memberName">이름</label>
            <input id="memberName" class="form-control input-lg" type="text" name="memberName" placeholder="User Name">
          </div>

          <div class="form-group">
            <label for="memberPw">비밀번호</label>
            <input id="memberPw" class="form-control input-lg" type="password" name="memberPw" placeholder="Password">
          </div>

          <div class="form-group">
            <label for="memberPw2">비밀번호 확인</label>
            <input id="memberPw2" class="form-control input-lg" type="password" name="memberPw2" placeholder="Password">
          </div>

          <div class="form-group">
          <input id="pwCheck2" type="hidden" class="alert alert-danger" role="alert" name="pwCheck2">
          </div>

          <div class="form-group">
            <label for="memberEmail">이메일</label>
            <input id="memberEmail" class="form-control input-lg" type="email" name="memberEmail" placeholder="Email">
          </div>

          <div class="form-group">
            <label for="memberPhone">휴대폰 번호</label>
            <input id="memberPhone" class="form-control input-lg" type="phone" name="memberPhone" placeholder="Phone Number">
          </div>

          <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:30px">가입하기</button>

        </form>
        
      </div>

    </div>
  </div>


<!-- 

  <h1><div style="text-align:center">D.NMD</div></h1>
  <h4><div style="text-align:center">회원가입</div></h4>

  <form name="form name" action="success.php" method="post" onsubmit="return checkSubmit()">
    <table>

      <tr>
        <td>아이디</td>
        <td><input type="text" id="memberId" name="memberId" value="" placeholder="id" class="memberId"></td>
        <td><input type="button" id="memberIdCheck" name="memberIdCheck" value="중복확인" class="memberIdCheck"></td>
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
  </form> -->


  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="js/join.js"></script>

</body>
</html>
