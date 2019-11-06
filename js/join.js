
$(function(){

    var memberIdCheck = document.getElementById('memberIdCheck');
    var memberId = document.getElementById('memberId');
    var memberPw = document.getElementById('memberPw');
    var memberPw2 = document.getElementById('memberPw2');
    var memberEmail = document.getElementById('memberEmail');
    var memberPhone = document.getElementById('memberPhone');

    memberIdCheck.onclick = function() {

        console.log(memberId.value);

        $.ajax({
    
            type: 'post',
            dataType: 'json',
            url: 'idCheck.php',
            data: {memberId: memberId.value},
    
            success: function(json) {
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
    };

    $('#memberPw2').keyup(function() {

        if(memberPw.value == memberPw2.value) {

            // document.getElementById('pwerror').style.display='none';
            $('#pwError').hide();
            pwCheck2.val('1');

        } else {

            // document.getElementById('pwerror').style.display='block';
            $('#pwError').show();

        }

    });

    $('#memberEmail').keyup(function() {

        var reg = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

        if(reg.test(memberEmail.value)) {

            $('#emailError').hide();
            emailCheck.val('1');
        } else {

            $('#emailError').show();
        }
    });

    $('#memberPhone').keyup(function() {

        var reg = /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/;

        if(reg.test(memberPhone.value)) {

            $('#phoneError').hide();
            phoneCheck.val('1');
        } else {

            $('#phoneError').show();
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
