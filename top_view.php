

    <!-- 상단 네비게이션바 시작 -->
    <nav class="navbar navbar-default">
      
      <!-- 모바일 사이즈로 브라우저 너비가 좁아질 경우, 메뉴로 보여짐 -->
      <div class="navbar-header">
        <a class="navbar-brand" href="main.php">D.NMD</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <!-- 일반 브러우저 사이즈일때, 보여짐 -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          
          <!-- 로그인하지 않았을때, -->
          <?php
            if(!isset($_SESSION['ses_userid'])) { ?>
              <li><a href="login.php">로그인</a></li>
              <li><a href="join.php">회원가입</a></li>
              <li><a href="inquiry_write.php">1:1문의하기</a></li>

              <!-- 로그인 했을때, -->
            <?php } else {

              $ses_userid=$_SESSION['ses_userid'];

              $name_sql="SELECT *FROM member WHERE memberId='$ses_userid'";
              $name_res=$connect->query($name_sql);
              $name_row=$name_res->fetch_assoc();
              $name = $name_row['name'];

              // 관리자가 로그인 했을때,
              if($_SESSION['ses_userid'] == 'admin') { ?>

                <p class="navbar-text">
                <?php echo "<strong>$name</strong> 님"?>
                </p>
                <li><a href="logout.php">로그아웃</a></li>
                <li><a href="admin.php">관리페이지</a></li>

                <!-- 일반 사용자가 로그인 했을때, -->
              <?php } else { ?>

                <p class="navbar-text">
                <?php echo "<strong>$name</strong> 님"?>
                </p>
                <li><a href="logout.php">로그아웃</a></li>
                <li><a href="inquiry_write.php">1:1문의하기</a></li>
                <li><a href="cart.php">나의 디노마드</a></li>

              <?php } 

             } ?>

        </ul>
      </div>
    </nav>

