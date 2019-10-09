$(function(){

    //아이디 중복 확인 소스
    var memberIdCheck = $('.memberIdCheck');
    var memberId = $('.memberId');
    var memberPw = $('.memberPw');
    var memberPw2 = $('.memberPw2');
    var memberPw2Comment = $('.memberPw2Comment');
    var memberEmail = $('.memberEmail');
    var memberPhone = $('.memberPhone');
    var memberEmailComment = $('.memberEmailComment');
    var memberPhoneComment = $('.memberPhoneComment');
    var idCheck = $('.idCheck');
    var pwCheck2 = $('.pwCheck2');
    var emailCheck = $('.emailCheck');
    var phoneCheck = $('.phoneCheck');

    memberIdCheck.click(function(){
        console.log(memberId.val());
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '../dnmd/idCheck.php',
            data: {memberId: memberId.val()},

            success: function (json) {
                if(json.res == 'good') {
                    console.log(json.res);
                    alert('사용가능한 아이디 입니다.');
                    idCheck.val('1');
                }else{
                    alert('다른 아이디를 입력해 주세요.');
                    memberId.focus();
                }
            },

            error: function(){
              console.log('failed');

            }
        })
    });

    //비밀번호 동일 한지 체크
    memberPw2.blur(function(){
      if(memberPw.val() != '' && memberPw2.val() != ''){
       if(memberPw.val() == memberPw2.val()){
           memberPw2Comment.text('비밀번호가 일치합니다.');
           pwCheck2.val('1');
       }else{
           memberPw2Comment.text('비밀번호가 일치하지 않습니다.');
       }}else {
         memberPw2Comment.text('비밀번호를 입력하세요');
       }
    });

    //이메일 유효성 검사
    memberEmail.blur(function(){
        var regex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
        if(regex.test(memberEmail.val()) == false){
            memberEmailComment.text('이메일을 바르게 입력하세요.');
            emailCheck.val('1');
        }else{
            memberEmailComment.text('확인됐습니다.');
        }
    });

    memberPhone.blur(function(){
        var reg=/^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/;
        if(reg.test(memberPhone.val()) == false){
            memberPhoneComment.text('연락처를 바르게 입력하세요.');
            phoneCheck.val('1');
        }else{
            memberPhoneComment.text('확인됐습니다.');
        }
    });

});

function checkSubmit(){
    var idCheck = $('.idCheck');
    var pwCheck2 = $('.pwCheck2');
    var emailCheck = $('.emailCheck');
    var memberName = $('.memberName');
    var phoneCheck = $('.phoneCheck');


    if(idCheck.val() == '1'){
        res = true;
    }else{
        res = false;
    }

    if(memberName.val() != ''){
        res = true;
    }else{
        res = false;
    }

    if(pwChck2.val() != '' && pwCheck2.val() == '1'){
        res = true;
    }else{
        res = false;
    }

    if(emailCheck.val() == '1'){
        res = true;
    }else{
        res = false;
    }

    if(phoneCheck.val() == '1'){
        res = true;
    }else{
        res = false;
    }

    if(res == false){
        alert('빈 칸을 채워주세요.');
    }
    return res;

}
