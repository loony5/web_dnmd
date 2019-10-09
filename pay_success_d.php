<?php
    include "../dnmd/include/connect.php";
    session_start();

    $memberId = $_SESSION['ses_userid'];

    $no = $_GET['no'];

    $query = "select *from class where no = '$no'";
    $res = $connect->query($query);
    $ro = $res->fetch_assoc();

    $num = $ro['no'];
    $title = $ro['title'];
    $teacher = $ro['teacher'];
    $date = $ro['date'];
    $time = $ro['time'];
    $place = $ro['place'];
    $peoples = $ro['peoples'];
    $charge = $ro['charge'];
    $content = $ro['content'];
    $image = $ro['image'];


    $qu ="insert into payment_list (no, num, memberId, title, teacher, date, time,
          charge, image) values (null, '$num', '$memberId', '$title',
          '$teacher', '$date', '$time', '$charge', '$image')";

    $re = $connect->query($qu);

    $sq = "delete from cart where no = $no";
    $r = $connect->query($sq);

    if($re && $r){

      $f_sql = "select count(*) as cnt from payment_list where num = '$num'";
      $f_result = $connect->query($f_sql);
      $f_row = $f_result->fetch_assoc();

      $f_cnt = $f_row['cnt'];

      if($peoples == $f_cnt){

        $past_sql = "insert into past (no, class_num, title, teacher, date, time, place, peoples,
        charge, content, image) values (null, '$num', '$title', '$teacher', '$date', '$time',
        '$place', '$peoples', '$charge', '$content', '$image')";

        $past_result = $connect->query($past_sql);

        if($past_result){

          $class_sql = "delete from class where no = '$num'";
          $class_result = $connect->query($class_sql);

          if($class_result){ ?>

            <script>
            location.href="receipt.php";
            </script>

          <?php }
        }

      } else { ?>

        <script>
        location.href="receipt.php";
        </script>

      <?php }} else {
        echo "FAIL";
      }  ?>
