<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width", initial-scale="1">
  <title>D.NMD</title>
  <link rel="stylesheet" href="css/bootstrap.css">

  <style>
      .warning{
      display: none;
      }

      body {
        background-color: #eee;
      }
  </style>

</head>

<body>

  <div class="container">
  <h2 class="text-center" style="margin-top:50px; margin-bottom:50px">D.NMD</h2>

    <div class="row">

      <div class="col-md-6 col-md-offset-3">

        <form action="success.php" method="post" onsubmit="return checkSubmit()">
          
          <label for="memberId">아이디</label>
          <div class="input-group input-group-lg" style="margin-bottom:15px">
            <input id="memberId" class="form-control" type="text" name="memberId" value="" placeholder="User ID" required autofocus>
            <span class="input-group-btn">
            <input id="memberIdCheck" class="btn btn-default" type="button" name="memberIdCheck" value="중복확인">
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
            <input id="memberPw2" class="form-control input-lg" role="alert" type="password" name="memberPw2" placeholder="Password">
          </div>

          <div id="pwError" class="form-group warning">
            <span class="text-danger">비밀번호가 일치하지 않습니다.</span>
          </div>

          <div class="form-group">
          <input id="pwCheck2" type="hidden" class="alert alert-danger" role="alert" name="pwCheck2">
          </div>

          <div class="form-group">
            <label for="memberEmail">이메일</label>
            <input id="memberEmail" class="form-control input-lg" type="text" name="memberEmail" placeholder="Email">
          </div>

          <div id="emailError" class="form-group warning">
            <span class="text-danger">이메일을 바르게 입력하세요.</span>
          </div>

          <div class="form-group">
            <label for="memberPhone">휴대폰 번호</label>
            <input id="memberPhone" class="form-control input-lg" type="text" name="memberPhone" placeholder="Phone Number">
          </div>

          <div id="phoneError" class="form-group warning">
            <span class="text-danger">연락처를 바르게 입력하세요.</span>
          </div>

          <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:30px; margin-bottom:100px;">가입하기</button>

        </form>
        
      </div>

    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <!-- <script src="js/join.js?v=<%=System.currentTimeMills() %>"></script> -->
  <script src="js/join.js?ver=1"></script>

</body>
</html>
