<!DOCTYPE html>
<?php
  session_start();
  include "../dnmd/include/connect.php";

  /* 페이징 시작 */
	//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
	if(isset($_GET['page'])) {

		$page = $_GET['page'];

	} else {

		$page = 1;

	}

	$sql = 'select count(*) as cnt from board order by no desc';

	$result = $connect->query($sql);

	$row = $result->fetch_assoc();


	$allPost = $row['cnt']; //전체 게시글의 수
	$onePage = 10; // 한 페이지에 보여줄 게시글의 수.
	$allPage = ceil($allPost / $onePage); //전체 페이지의 수



	if($page < 1 || ($allPage && $page > $allPage)) {

?>
		<script>
			alert("존재하지 않는 페이지입니다.");
			history.back();
		</script>

<?php

		exit;

	}



	$oneSection = 5; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)

	$currentSection = ceil($page / $oneSection); //현재 섹션

	$allSection = ceil($allPage / $oneSection); //전체 섹션의 수


	$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지


	if($currentSection == $allSection) {

		$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.

	} else {

		$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지

	}


	$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.

	$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.



	$paging = '<ul>'; // 페이징을 저장할 변수


	//첫 페이지가 아니라면 처음 버튼을 생성

	// if($page != 1) {
  //
	// 	$paging .= '<li class="page page_start"><a href="./inquiry.php?page=1">처음</a></li>';
  //
	// }

	//첫 섹션이 아니라면 이전 버튼을 생성

	if($currentSection != 1) {

		$paging .= '<li class="page page_prev"><a href="./inquiry.php?page=' . $prevPage . '">이전</a></li>';

	}



	for($i = $firstPage; $i <= $lastPage; $i++) {

		if($i == $page) {

			$paging .= '<li class="page current">' . $i . '</li>';

		} else {

			$paging .= '<li class="page"><a href="./inquiry.php?page=' . $i . '">' . $i . '</a></li>';

		}

	}



	//마지막 섹션이 아니라면 다음 버튼을 생성

	if($currentSection != $allSection) {

		$paging .= '<li class="page page_next"><a href="./inquiry.php?page=' . $nextPage . '">다음</a></li>';

	}



	//마지막 페이지가 아니라면 끝 버튼을 생성

	// if($page != $allPage) {
  //
	// 	$paging .= '<li class="page page_end"><a href="./inquiry.php?page=' . $allPage . '">끝</a></li>';
  //
	// }

	$paging .= '</ul>';


	/* 페이징 끝 */
  $currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
  $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문
  $sql = 'select * from board order by no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지

  $result = $connect->query($sql);

  ?>


 <html>
  <head>
    <meta charset="utf-8">
    <title>D.NMD</title>
    <link rel="stylesheet" href="./css/normalize.css"/>
    <link rel="stylesheet" href="./css/board.css"/>
    <style>
     ul{list-style: none; display: table; padding: 0;}
     li {float: left; margin-right: 5px; margin-left: 5px;}
    </style>
  </head>

  <body>
    <article class="boardArticle">
      <h1><div style="text-align:center"><a href="../dnmd/main.php">D.NMD</a></div></h1>
      <h4><div style="text-align:center">문의하기</div></h4>

      <table align=center>

        <thead>
          <tr>
            <th scope="col" class="no">번호</th>
            <th scope="col" class="title">제목</th>
            <th scope="col" class="memberId">작성자</th>
            <th scope="col" class="date">작성일</th>
          </tr>
        </thead>

        <tbody>
          <?php
            // $sql = 'select *from board order by no desc'.$sqlLimit;
            // $result = $connect->query($sql);

            while($row = $result->fetch_assoc()){
              $datetime = explode(' ', $row['date']);
							$date = $datetime[0];
							$time = $datetime[1];

              if($date == Date('Y-m-d')){
                $row['date'] = $time;
              } else {
                $row['date'] = $date;
              }

           ?>

           <tr>
             <td class="no"><?php echo $row['no'] ?></td>
             <td class="title" align=center>
               <a href = "view.php?no=<?php echo $row['no']?>">
               <?php echo $row['title'] ?></td>
             <td class="memberId"><?php echo $row['memberId'] ?></td>
             <td class="date"><?php echo $row['date'] ?></td>
           </tr>

         <?php } ?>

       </tbody>

     </table>
     <div class="view_btn" align=center></br>
             <button class="view_btn1" onclick="location.href='./write.php'">글쓰기</button>
     </div>
     <div class = "paging" align=center>
       <?php echo $paging ?>
     </div>

    </article>
  </body>
 </html>
