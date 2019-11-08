<!DOCTYPE html>

<?php 
    include 'include/connect.php';
    session_start();

    $no = $_GET['no'];

    $sql = "SELECT * FROM class WHERE no = '$no'";
    $row = mysqli_fetch_assoc($connect -> query($sql));

    // '나의 디노마드'에서 이미 마감된 수업의 상세페이지에 접근할 때,
    if(!isset($row)) {

        $sql = "SELECT * FROM past WHERE class_num = '$no'";
        $past_row = mysqli_fetch_assoc($connect -> query($sql));

        // 수업을 결제한 인원 수 구하기
        $sql = "SELECT count(*) as cnt FROM payment_list WHERE num = '$no'";
        $cnt = mysqli_fetch_assoc($connect -> query($sql));

    }

    $sql = "SELECT count(*) as cnt FROM payment_list WHERE num = '$no'";
    $cnt_row = mysqli_fetch_assoc($connect->query($sql));

    
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width", initial-scale="1">
    <title>D.NMD</title>
    <link rel="stylesheet" href="css/bootstrap.css">

    <style>
        body > p {
            font-size: 16px;
            line-height: 180%;
        }

        body > ul {
            font-size: 16px;
            margin-top: 40px;
        }

        body > li {
            margin-bottom: 10px;
        }

    </style>
</head>
<body>

    <!-- 상단 네비게이션 바 -->
    <?php include 'view/top_view.php';
    
    // 마감된 수업일 때, 
    if(!isset($row)){ ?>

    <div class="container">
        <h2 class="text-center" style="margin-top:30px; margin-bottom:50px"><span style="color:red">[마감] </span><?=$past_row['title']?></h2>
        <h4 class="text-center" style="margin-bottom:50px">강사 : <?=$past_row['teacher']?></h4>

        <div class="row">
            <div class="col-lg-7">

                <p><?=$past_row['content']?></p>

                <ul>
                    <li>일자 : <?=$past_row['date']?></li>
                    <li>시간 : <?=$past_row['time']?></li>
                    <li>장소 : <?=$past_row['place']?></li>
                    <li>정원 : 0 - <?=$past_row['peoples']?> 명</li>
                    <li style="color:red">비용 : 마감</li>
                </ul>
                
            </div>

            <div class="col-lg-5">
                <img class="img-responsive img-rounded" src="images/<?=$past_row['image']?>">
            </div>

        </div>

        <hr>

        <div class="col-md-4"></div>
        <div class="col-md-4" style="margin-top:20px; margin-bottom:20px">
            <button class="btn btn-lg btn-info btn-block" type="button" onclick="location.href='receipt.php'">돌아가기</button>
        </div>

    </div>

        <?php 
        
    } else { ?>

        <div class="container">
            <h2 class="text-center" style="margin-top:30px; margin-bottom:50px"><?php if(($row['peoples']-$cnt_row['cnt']) <= 2) { ?>
                <span style="color:red">[마감임박] </span><?=$row['title']; } else {echo $row['title']; } ?></h2>
            <h4 class="text-center" style="margin-bottom:50px">강사 : <?=$row['teacher']?></h4>

            <div class="row">
                <div class="col-lg-7">

                    <p><?=$row['content']?></p>

                    <ul>
                        <li>일자 : <?=$row['date']?></li>
                        <li>시간 : <?=$row['time']?></li>
                        <li>장소 : <?=$row['place']?></li>
                        <li>정원 : 0 - <?=$row['peoples']?> 명</li>
                        <li>비용 : <?=$row['charge']?> 원</li>
                    </ul>
                    
                </div>

                <div class="col-lg-5">
                    <img class="img-responsive img-rounded" src="images/<?=$row['image']?>">
                </div>

            </div>

            <hr>

            <div class="col-md-2"></div>
            <div class="col-md-4" style="margin-top:20px; margin-bottom:20px">
                <button class="btn btn-lg btn-info btn-block" type="button" onclick="location.href='cart_update.php?no=<?php echo $no ?>'">담아두기</button>
            </div>

            <div class="col-md-4" style="margin-top:20px; margin-bottom:20px">
                <button class="btn btn-lg btn-primary btn-block" type="button" onclick="location.href='payment.php?no=<?php echo $no ?>'">참여하기</button>
            </div>

        </div>

    <?php
     
    } 

    include 'view/bottom_view.php';
    
    ?>

</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>

</html>