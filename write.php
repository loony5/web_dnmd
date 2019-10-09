<!DOCTYPE html>
<?php
  session_start();
  $URL = "./index.php";
  if(!isset($_SESSION['ses_userid'])){

     ?>
     <script>
      alert("로그인이 필요합니다.");
      location.replace("<?php echo "./login.php"?>");
    </script>
    <?php
  } ?>

<?php
  include "../dnmd/include/connect.php";
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
      <h4><div style="text-align:center">문의하기</div></h4>

      <div id="boardWrite">
        <form action="./write_update.php" method="post">
          <table id="boardWrite" align=center>

            <tbody>
              <tr>
                <th scope="row"><label for="memberId">작성자</label></th>
                <td class="id"><input type="hidden" name="memberId" id="memberId" value="<?=$_SESSION['ses_userid']?>"><?=$_SESSION['ses_userid']?></td>
              </tr>

              <tr>
                <th scope="row"><label for="title">제목</label></th>
                <td class="title"><input type="text" name="title" id="title"></td>
              </tr>

              <tr>
                <th scope="row"><label for="content">내용</label></th>
                <td class="content"><textarea name="content" id="content"></textarea></td>
              </tr>
            </tbody>

          </table>
          <div class="btnSet">
            <button type="submit" class="btnSubmit btn">작성</button>
            <button type="button" class="view_btn1" onclick="location.href='javascript:history.back()'">이전</button>
          </div>
        </form>
      </div>
  </body>
</html>
