
<!DOCTYPE html>
<?php
  include "../dnmd/include/connect.php";
  session_start();

  // 마감되지 않은 수업의 상세페이지에 접근할 때,
  $no = $_GET['no'];
  $class_sql = "SELECT * FROM class WHERE no = $no";
  $class_result = $connect -> query($class_sql);
  $class_row = mysqli_fetch_assoc($class_result);


  // '나의 디노마드'에서 이미 마감된 수업의 상세페이지에 접근할 때,
  if(!isset($class_row)){

    $past_sql = "SELECT * FROM past WHERE class_num = '$no'";
    $past_result = $connect -> query($past_sql);
    $past_row = $past_result->fetch_assoc();

  }

  // 수업을 결제한 인원 수 구하기
  $cnt_sql = "SELECT count(*) as cnt FROM payment_list WHERE num = '$no'";
  $cnt_result = $connect->query($cnt_sql);
  $cnt_row = $cnt_result->fetch_assoc();
  
  $peoples = $class_row['peoples'];
  $cnt_p = $cnt_row['cnt'];

  ?>

<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>D.NMD</title>

  <link href="./css/bootstrap_2.min.css" rel="stylesheet">
  <link href="./css/modern-business.css" rel="stylesheet">

</head>

<body>

  <div class="container">

    <div class="row">

      <!-- 왼쪽 정보 영역 -->
      <div class="col-lg-6">

        <!--  수업이 마감되어 class db 에 수업이 없을 때, 마감된 수업 db의 정보를 보여준다 -->
        <h2><?php if(!isset($class_row)){ echo $past_row['title']; 
        } else {echo $class_row['title'];}?></h2>

        <p><?php if(!isset($class_row)){ echo $past_row['teacher']; 
        } else {echo $class_row['teacher'];}?></p>
        
        <ul>
          <li><?php if(!isset($class_row)){ echo $past_row['date']; 
          } else {echo $class_row['date'];}?></li>
          
          <li><?php if(!isset($class_row)){ echo $past_row['time']; 
          } else {echo $class_row['time'];}?></li>
          
          <li><?php if(!isset($class_row)){ echo $past_row['place']; 
          } else {echo $class_row['place'];}?></li>
          
          <li><?php if(!isset($class_row)){ ?> <span style="color:red">마감</span> <?php 
          } else {

            if($peoples == $cnt_p){ ?>
              <span style="color:red">마감</span>
            <?php 
            } else { echo "0 - " . $peoples . " 명"; 
            };
            
          }?></li>

          <li><?php if(!isset($class_row)){ echo $past_row['charge']; 
          } else { echo number_format($class_row['charge']);
          }?>원
          </li>

        </ul>
        
        <p><?php if(!isset($class_row)){ echo $past_row['content']; } else {
          echo $class_row['content'];}?></p>

      </div>

      <!-- 오른쪽 이미지 영역 -->
      <div class="col-lg-6">

        <?php if(!isset($class_row)){ ?> <img class="img-fluid rounded" src="images/<?php echo $past_row['image']?>"> 
          <?php } else { ?>
        <img class="img-fluid rounded" src="images/<?php echo $class_row['image']?>"> 
        <?php } ?>

      </div>

    </div>

    <hr>

    <!-- 정원이 다 차지 않았을 경우 '담아두기', '참여하기' 버튼을 보여주고 
    그렇지 않으면 '돌아가기' 버튼 -->
    
    <?php if($peoples > $cnt_p){ ?>

        <div class="row mb-4">

          <div class="col-md-4">
            <a class="btn btn-lg btn-secondary btn-block" href="my_update.php?no=<?php echo $no ?>">담아두기</a>
          </div>
          <div class="col-md-4">
            <a class="btn btn-lg btn-secondary btn-block" href="./payment_d.php?no=<?php echo $no ?>">참여하기</a>
          </div>
    </div>

  <?php } else { ?>

    <div class="col-md-4">
      <a class="btn btn-lg btn-secondary btn-block" href="javascript:history.back()">돌아가기</a>
    </div>

  <?php } ?>

  </div>

</body>

</html>
