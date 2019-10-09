
<!DOCTYPE html>
<?php
  include "../dnmd/include/connect.php";
  session_start();

  $no = $_GET['no'];
  $sql = "select * from class where no = $no";
  $result = $connect -> query($sql);
  $row = mysqli_fetch_assoc($result);

  if(!isset($row)){

    $past_sql = "select * from past where class_num = '$no'";
    $past_result = $connect -> query($past_sql);
    $past_row = $past_result->fetch_assoc();

  }

  $query = "select count(*) as cnt from payment_list where num = '$no'";
  $res = $connect->query($query);
  $ro = $res->fetch_assoc();

  
  $peoples = $row['peoples'];
  $cnt_p = $ro['cnt'];


  ?>

<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>D.NMD</title>

  <!-- Bootstrap core CSS -->
  <link href="./css/bootstrap_2.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="./css/modern-business.css" rel="stylesheet">

</head>

<body>

  <!-- Page Content -->
  <div class="container">

    <!-- Features Section -->
    <div class="row">
      <div class="col-lg-6">
        <h2><?php if(!isset($row)){ echo $past_row['title']; } else {echo $row['title'];}?></h2>
        <p><?php if(!isset($row)){ echo $past_row['teacher']; } else {echo $row['teacher'];}?></p>
        <ul>
          <li><?php if(!isset($row)){ echo $past_row['date']; } else {echo $row['date'];}?></li>
          <li><?php if(!isset($row)){ echo $past_row['time']; } else {echo $row['time'];}?></li>
          <li><?php if(!isset($row)){ echo $past_row['place']; } else {echo $row['place'];}?></li>
          <li><?php if(!isset($row)){ ?> <span style="color:red">마감</span> <?php } else {



          if($peoples == $cnt_p){ ?>

            <span style="color:red">마감</span>

          <?php } else { echo "0 - "; echo $peoples; };}?></li>

          <li><?php if(!isset($row)){ echo $past_row['charge']; } else {echo number_format($row['charge']);}?>원</li>
        </ul>
        <p><?php if(!isset($row)){ echo $past_row['content']; } else {echo $row['content'];}?></p>
      </div>
      <div class="col-lg-6">
        <?php if(!isset($row)){ ?> <img class="img-fluid rounded" src="images/<?=$past_row['image']?>" alt=""> <?} else { ?>
        <img class="img-fluid rounded" src="images/<?=$row['image']?>" alt=""> <?php } ?>
      </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Call to Action Section -->

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
  <!-- /.container -->

</body>

</html>
