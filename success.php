<?php
    include "../dnmd/include/connect.php";
    /*echo "<pre>";
    echo var_dump($_POST);*/

    $memberId = $_POST['memberId'];
    $memberName = $_POST['memberName'];
    $memberPw = $_POST['memberPw'];
    $memberPw2 = $_POST['memberPw2'];
    $memberEmail = $_POST['memberEmail'];
    $memberPhone = $_POST['memberPhone'];

    //PHP에서 유효성 재확인

    if($memberId == '' || $memberName == '' || $memberPw == '' || $memberPw2 == '' ||
    $memberEmail == '' || $memberPhone == ''){

      ?>

      <script>
      alert('빈칸이 있습니다. 바르게 입력해주세요.');
      history.go(-1);
      </script>
    <?php } else {

    //아이디 중복검사.
    $sql = "SELECT * FROM member WHERE memberId = '{$memberId}'";
    $res = $connect->query($sql);
    if($res->num_rows >= 1){
        echo '이미 존재하는 아이디가 있습니다.';
        exit;
    }

    //비밀번호 일치하는지 확인
    if($memberPw != $memberPw2){
        echo '비밀번호가 일치하지 않습니다.';
        exit;
    }else{
        //비밀번호를 암호화 처리.
        $memberPw = md5($memberPw);
    }

    //이메일 주소가 올바른지
    $checkEmail = filter_var($memberEmail, FILTER_VALIDATE_EMAIL);

    if($checkEmail != true){
        echo '올바른 이메일 주소가 아닙니다.';
        exit;
    }

    //이제부터 넣기 시작
    $sql = "INSERT INTO member VALUES('','{$memberId}','{$memberName}','{$memberPw}','{$memberEmail}','{$memberPhone}');";


    if($connect->query($sql)){

      print "<script language=javascript> alert('가입이 완료되었습니다.'); location.href='login.php'; </script>";
       // echo '<script>alert('가입이 완료되었습니다.);location.replace('../dnmd/login.php');</script>';

    }
  }

?>
