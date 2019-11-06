$(function(){

    var payment = document.getElementById('payment');
    var title = document.getElementById('title').value;
    var charge = document.getElementById('charge').value;
    var class_no = document.getElementById('class_no').value;
  
    payment.onclick = function() {

        var IMP = window.IMP;
        IMP.init('imp41319736');

        IMP.request_pay({
        pg : 'inicis', // version 1.1.0부터 지원.
        pay_method : 'card',
        merchant_uid : 'merchant_' + new Date().getTime(),
        name : title,
        amount : charge,
        buyer_email : '',
        buyer_name : 'D.NMD',
        buyer_tel : '010-1234-5678',
        buyer_addr : '',
        buyer_postcode : '',
        m_redirect_url : ''
        }, function(rsp) {
            if ( rsp.success ) {
                var msg = '결제가 완료되었습니다.';
                // msg += '고유ID : ' + rsp.imp_uid;
                // msg += '상점 거래ID : ' + rsp.merchant_uid;
                msg += '결제 금액 : ' + rsp.paid_amount;
                // msg += '카드 승인번호 : ' + rsp.apply_num;

                alert(msg);
                location.href="payment_success.php?no=" + class_no;

            } else {
                var msg = '결제에 실패하였습니다.';
                msg += '에러내용 : ' + rsp.error_msg;
                alert(msg);
            }

        });
  
    };
  
});
