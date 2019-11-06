<?php
    include "include/connect.php";
    session_start();

    $memberId = $_SESSION['ses_userid'];

    $class_no = $_GET['no'];

    $cart_sql = "SELECT *FROM cart WHERE num = '$class_no' AND memberId = '$memberId'";
    $cart_row = mysqli_fetch_assoc($connect->query($cart_sql));

    if(!isset($cart_row)) {

        // 사용자 장바구니에 결제한 수업이 없으면,
        // 결제 완료 테이블에 업로드하고,
        // 결제 완료 테이블의 해당 수업 정원이 수업 테이블 정원과 같으면
        // 마감 테이블로 업로드하고 기존 수업 테이블에 해당 수업 삭제

        $sql = "SELECT *FROM class WHERE no = '$class_no'";
        $row = mysqli_fetch_assoc($connect->query($sql));

        if($row) {

            $title = $row['title'];
            $teacher = $row['teacher'];
            $date = $row['date'];
            $time = $row['time'];
            $charge = $row['charge'];
            $image = $row['image'];

            // 결제완료 테이블에 삽입
            $sql = "INSERT INTO payment_list (no, num, memberId, title, teacher, date, time,
            charge, image) VALUES (null, '$class_no', '$memberId', '$title', '$teacher', '$date', '$time', 
            '$charge', '$image')";

            $connect->query($sql);

            // 해당 수업을 결제한 총 합계 구하기
            $sql = "SELECT count(*) as cnt FROM payment_list WHERE num = '$class_no'";
            $cnt = mysqli_fetch_assoc($connect->query($sql));

            // 해당 수업의 결제 합계와 수업 정원의 수가 같을 때,
            // 마감 테이블로 업로드하고 기존 수업 테이블의 해당 수업 삭제
            if($row['peoples'] == $cnt['cnt']) {

                $place = $row['place'];
                $peoples = $row['peoples'];
                $content = $row['content'];

                $sql = "INSERT INTO past (no, class_num, title, teacher, date, time, place, peoples,
                        charge, content, image) VALUES (null, '$class_no', '$title', '$teacher', '$date', '$time', '$place', $peoples, 
                        '$charge', '$content', '$image')";
                
                $connect->query($sql);

                $sql = "DELETE FROM class WHERE no = '$class_no'";
                $connect->query($sql);

                echo ("<script>location.href='receipt.php';</script>");

            }

        }

    } else {

        // 사용자 장바구니에 결제한 수업이 있으면,
        // 장바구니 테이블에 해당 수업 삭제하고,
        // 결제 완료 테이블에 업로드한다.
        // 결제 완료 테이블의 해당 수업 정원이 수업 테이블 정원과 같으면
        // 마감 테이블로 업로드하고 기존 수업 테이블에 해당 수업 삭제

        $sql = "DELETE FROM cart WHERE num = '$class_no' AND memberId = '$memberId'";
        $connect->query($sql);

        $sql = "SELECT *FROM class WHERE no = '$class_no'";
        $row = mysqli_fetch_assoc($connect->query($sql));

        if($row) {

            $title = $row['title'];
            $teacher = $row['teacher'];
            $date = $row['date'];
            $time = $row['time'];
            $charge = $row['charge'];
            $image = $row['image'];

            // 결제완료 테이블에 삽입
            $sql = "INSERT INTO payment_list (no, num, memberId, title, teacher, date, time,
            charge, image) VALUES (null, '$class_no', '$memberId', '$title', '$teacher', '$date', '$time', 
            '$charge', '$image')";

            $connect->query($sql);

            // 해당 수업을 결제한 총 합계 구하기
            $sql = "SELECT count(*) as cnt FROM payment_list WHERE num = '$class_no'";
            $cnt = mysqli_fetch_assoc($connect->query($sql));

            // 해당 수업의 결제 합계와 수업 정원의 수가 같을 때,
            // 마감 테이블로 업로드하고 기존 수업 테이블의 해당 수업 삭제
            if($row['peoples'] == $cnt['cnt']) {

                $place = $row['place'];
                $peoples = $row['peoples'];
                $content = $row['content'];

                $sql = "INSERT INTO past (no, class_num, title, teacher, date, time, place, peoples,
                        charge, content, image) VALUES (null, '$class_no', '$title', '$teacher', '$date', '$time', '$place', $peoples, 
                        '$charge', '$content', '$image')";
                
                $connect->query($sql);

                $sql = "DELETE FROM class WHERE no = '$class_no'";
                $connect->query($sql);

                echo ("<script>location.href='receipt.php';</script>");

            }

        }

    }
 ?>
