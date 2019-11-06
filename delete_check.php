<?php

    session_start();
    include "../dnmd/include/connect.php";

    // 관리자 아이디로 로그인이 아닐경우 경고창
    if(!isset($_SESSION['ses_userid']) || $_SESSION['ses_userid'] != 'admin') {

        ?>
        <script>
        alert("권한이 없습니다.");
        location.replace("<?php echo "main.php"?>");
        </script>
    <?php }

    $no = $_GET['no'];
    
    ?>

    <!-- 삭제 확인 창 -->
    <script>
        var check;
        check = confirm("수업을 정말 삭제하시겠습니까?");

        if(check == true) {

            location.href="class_delete_update.php?no=<?php echo $no?>";
        } else {

            location.href="admin.php";
        }
    </script>
