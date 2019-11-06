<!DOCTYPE html>

<?php 

    session_start();
    include 'include/connect.php';

    $no = $_GET['no'];
    $sql = "SELECT *FROM class WHERE no = '$no'";
    $row = mysqli_fetch_assoc($connect->query($sql));

    $pay_sql = "SELECT count(*) as cnt FROM payment_list WHERE num = '$classNo'";
    $pay_row = mysqli_fetch_assoc($connect->query($pay_sql));

    $remainder = $class_row['peoples'] - $pay_row['cnt'];

    if(!isset($_SESSION['ses_userid'])) {

        ?>
        <script>
            alert("로그인이 필요합니다.");
            location.replace("<?php echo "login.php"?>");
        </script>
        <?php
    }
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width", initial-scale="1">
    <title>D.NMD</title>
    <link rel="stylesheet" href="css/bootstrap.css">

    <style>
        th , td {
        text-align: center;
        }
    </style>
</head>

<body>
    
    <?php include 'view/top_view.php'?>

    <div class="container">
        <h2 class="text-center" style="margin-top:30px; margin-bottom:50px">수강 신청</h2>   
    
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>수업정보</th>
                        <th>일자</th>
                        <th>시간</th>
                        <th>수업료</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><img class="img-rounded" width="50px" src="images/<?php echo $row['image']?>">
                            <a href = "class_detail.php?no=<?php echo $row['no']?>">
                            <?php 
                                if($remainder<=2 && $remainder!=0){

                                 echo $row['title']; ?>
                                <span style="color:red">-마감임박</span> <?php } 
                            
                                else { 
                                    echo $row['title'];
                                } ?>
                        </td>
                        <td style="text-align: center"><p><?php echo $row['date']?></p></td>
                        <td style="text-align: center"><p><?php echo $row['time']?></p></td>
                        <td style="text-align: center"><p><?php echo $row['charge']?></p></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="panel panel-default" style="margin-top:40px">
            <div class="panel-heading text-center">수강자 정보 확인</div>

            <div class="panel-body" style="padding:40px">
                <table class="table table-bordered" style="margin:0px">
                    <thead>
                        <tr>
                            <th>아이디</th>
                            <th>이름</th>
                            <th>연락처</th>
                            <th>이메일</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 

                            $memberId = $_SESSION['ses_userid'];
                            $member_sql = "SELECT *FROM member WHERE memberId = '$memberId'";
                            $member_row = mysqli_fetch_assoc($connect->query($member_sql));
                        ?>
                        <tr>
                            <td><?php echo $member_row['memberId']?></td>
                            <td><?php echo $member_row['name']?></td>
                            <td><?php echo $member_row['phone']?></td>
                            <td><?php echo $member_row['email']?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="col-md-4"></div>

        <div class="col-md-4" style="margin-top:20px; margin-bottom:20px">
            <input type="hidden" id="class_no" name="class_no" value="<?=$row['no']?>">
            <input type="hidden" id="title" name="title" value="<?=$row['title']?>">
            <input type="hidden" id="charge" name="charge" value="<?=$row['charge']?>">
            <button class="btn btn-lg btn-info btn-block" id="payment">결제하기</a>
        </div>

    </div>

    <?php include 'view/bottom_view.php'; ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/payment.js"></script>
    <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>

    
</body>
</html>