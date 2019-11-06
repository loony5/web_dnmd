
<!DOCTYPE html>
<?php
  session_start();
  include "include/connect.php";

  if(!isset($_SESSION['ses_userid']) || $_SESSION['ses_userid'] != 'admin'){

     ?>

     <script>
      alert("권한이 없습니다.");
      location.replace("<?php echo "./main.php"?>");
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
        th {
            text-align: center;
        }

        .td-ellipsis {
            display: inline-block;
            width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>

    <?php include 'top_view.php'?>

    <div class="container">
        <h2 class="text-center" style="margin-top:30px; margin-bottom:50px">관리페이지</h2>

        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="admin.php">수업관리</a></li>
            <li rold="presentation"><a href="inquiry_board.php">1:1 문의글 관리</a></li>
        </ul>

        <ol class="breadcrumb" style="height:50px; margin-top:15px; padding-top:15px; padding-bottom:15px">
            <li><a href="admin.php">진행중</a></li>
            <li class="active">마감</li>
        </ol>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>이미지</th>
                        <th>수업명</th>
                        <th>강사</th>
                        <th>일자</th>
                        <th>시간</th>
                        <th>정원</th>
                        <th>참여인원</th>
                        <th>수업료</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                     
                     $memberId = $_SESSION['ses_userid'];

                     $sql = "SELECT *FROM past ORDER BY NO DESC";
                     $result = $connect->query($sql);

                     while($row = $result->fetch_assoc()) {

                        $classNo = $row['no'];
                        $query = "SELECT count(*) as cnt FROM payment_list WHERE num = '$classNo'";
                        $pay_row=mysqli_fetch_assoc($connect->query($query));

                        $remainder = $row['peoples'] - $pay_row['cnt'];
                    ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['no']?></td>
                        <td><img class="img-rounded" width="50px" src="images/<?php echo $row['image']?>"></td>
                        <td><p class="td-ellipsis"><?php echo $row['title']?></p></td>
                        <td><p class="td-ellipsis"><?php echo $row['teacher']?></p></td>
                        <td><p class="td-ellipsis"><?php echo $row['date']?></p></td>
                        <td style="text-align: center"><p class="td-ellipsis" style="width:100px"><?php echo $row['time']?></p></td>
                        <td style="text-align: center"><?php echo $row['peoples']?></td>
                        <td style="text-align: center"><p style="color:red">마감</p></td>
                        
                        <td style="text-align: center"><?php echo number_format($row['charge'])?>원</td>
                        <td><input type="hidden" name="no" value="<?php echo $row['no']?>">
                        <input class="btn btn-default" type="button" name="update_btn" value="재등록" onclick="location.href='re_register.php?no=<?php echo $row['no']?>'">
                    </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>

    </div>

    <div class="paging" align=center>
        <?php echo $paging ?>
    </div>

</body>

</html>
