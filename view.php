<!DOCTYPE html>
<?php
  include "../dnmd/include/connect.php";
  $no = $_GET['no'];
  session_start();
  $ses_userid=$_SESSION['ses_userid'];

  $sql = "select title, content, date, memberId from board where no =$no";
  $result = $connect->query($sql);
  $row = mysqli_fetch_assoc($result);
?>

<html>
  <head>
    <meta charset="utf-8"/>
    <title>D.NMD</title>
    <style>
    <!--
    td { font-size : 12pt; }
    A:link { font : 12pt; color : black; text-decoration : none; font-family : 굴림; font-size : 9pt; }
    A:visited { text-decoration : none; color : black;    font-size : 9pt; }
    A:hover { text-decoration : underline; color : black; font-size : 9pt; }

    -->
    </style>
  </head>

  <body>

      <h1><div style="text-align:center">D.NMD</div></h1>
      <div id="boardView">
        <table width=720 border=0 cellpadding=2 cellspacing=1 bgcolor=#777777 align=center>
          <tr>
            <td height=30 colspan="4" bgcolor=#8EA8DB align=center>
              <font color=white><B><?php echo $row['title']?></B></font>
            </td>
          </tr>

          <tr>
            <td width=100 height=30 align=center bgcolor=#D9E5FF>작성자</td>
            <td width=240 bgcolor=white><?php echo $row['memberId']?></td>
            <td width=100 height=30 align=center bgcolor=#D9E5FF>작성일</td>
            <td width=240 bgcolor=white><?php echo $row['date']?></td>
          </tr>

          <tr>
            <td bgcolor=white colspan=4>
            <font color=black>
            <pre><?php echo $row['content']?></pre>
            </font>
            </td>
          </tr>

          <?php

          $usrid = $row['memberId'];
          if($usrid == $_SESSION['ses_userid']) { ?>

            <tr>
            <td bgcolor=white colspan=4 align=right>
            <button class="view_btn1" onclick="location.href='./modify.php?no=<?php echo $no?>'">수정</button>
            <button class="view_btn1" onclick="location.href='./delete.php?no=<?php echo $no?>'">삭제</button>
            </tr>


          <?php } ?>


        </table>

        <div class="comment" align=center></br>


        <?php include '../dnmd/comment.php'; ?>

        <?php if($ses_userid == 'admin') { ?>

          <tr>
          <td bgcolor=white colspan=4 align=center>
          <button class="view_btn1" onclick="location.href='./inquiry_board.php'">목록</button>
          </tr>

        <?php } else { ?>

        <tr>
        <td bgcolor=white colspan=4 align=center>
        <button class="view_btn1" onclick="location.href='./my_inquiry.php'">목록</button>
        </tr>

      <?php } ?>

        </div>
      </div>

  </body>
</html>
