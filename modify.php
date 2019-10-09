<?php
  include "../dnmd/include/connect.php";
  session_start();

  $no = $_GET['no'];
  $sql = "select title, content, date, memberId from board where no=$no";
  $result = $connect->query($sql);
  $row = $result->fetch_assoc();

  $title = $row['title'];
  $content = $row['content'];
  $usrid = $row['memberId'];

  if(!isset($_SESSION['ses_userid'])){

    ?>
    <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo "./main.php"?>");
    </script>
    <?php
  } else if ($_SESSION['ses_userid'] != $usrid) {
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
      <meta charset="utf-8">
      <title>D.NMD</title>
      <link rel="stylesheet" href="./css/normalize.css" />
    	<link rel="stylesheet" href="./css/board.css" />
    </head>

    <body>

        <h1><div style="text-align:center">D.NMD</div></h1>
        <h4><div style="text-align:center">글 수정하기</div></h4>

        <div id="boardWrite">
          <form action="./modify_action.php" method="post">
            <table id="boardWrite" align=center>
              <tbody>
                <tr>
                  <th scope="row"><label for="memberId">작성자</label></th>
                  <th class="id"><input type="hidden" name="memberId" id="memberId"
                    value="<?=$_SESSION['ses_userid']?>"><?=$_SESSION['ses_userid']?></td>
                </tr>

                <tr>
                  <th scope="row"><label for="title">제목</label></th>
                  <td class="title"><input type="text" name="title" id="title" value="<?=$title?>"></td>
                </tr>

                <tr>
                  <th scope="row"><label for="content">내용</label></th>
                  <td class="content"><textarea name="content" id="content"><?=$content?></textarea></td>
                </tr>
              </tbody>
            </table>
            <div class="btnSet">
              <input type="hidden" name="no" id="no" value="<?=$no?>">
              <button type="submit" class="btnSubmit btn">작성</button>
            </div>
          </form>
        </div>

    </body>
  </html>
