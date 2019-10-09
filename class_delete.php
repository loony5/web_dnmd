<!DOCTYPE html>
 <?php
   session_start();
   include "../dnmd/include/connect.php";

   $no = $_GET['no'];
   $sql = "select * from class where no=$no";
   $result = $connect->query($sql);
   $row = $result->fetch_assoc();

   if($_SESSION['ses_userid'] == 'admin'){ ?>

     <html>
      <head>
        <meta charset="utf-8"/>
        <title>D.NMD</title>
        <style>
        <!--
        td {font-size : 12pt;}
        A:link {font : 12pt;color : black;text-decoration : none;
        font-family: 굴림;font-size : 12pt;}
        A:visited {text-decoration : none; color : black; font-size : 12pt;}
        A:hover {text-decoration : underline; color : black;
        font-size : 12pt;}
        -->
        table {border-collapse: collapse;}
        </style>

      </head>

      <body>
      <body topmargin=100 leftmargin=0>
        <center>
          <BR>
          <form action=class_delete_update.php?no=<?=$_GET[no]?> method=post>
          <table width=300 border=1px solid gold cellpadding=2 cellspacing=1>
          <tr>
            <td height=30 align=center>
                <B>관리자 비밀번호확인</B>
            </td>
          </tr>
          <tr>
            <td height=30 align=center >
                <font color=black><B>비밀번호 : </b>
                <input type=password name=password size=8>
                <input type="hidden" name="no" id="no" value="<?=$no?>">
                <input type=submit value="확 인">
                <input type=button value="취 소" onclick="history.back(-1)">

            </td>
          </tr>
          </table>

      </body>
     </html>

  <?php } else { ?>


     <script>
     alert("권한이 없습니다.");
     location.replace("<?php echo "./main.php"?>");
     </script>

   <?php } ?>
