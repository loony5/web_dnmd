<!DOCTYPE html>
<?php
  session_start();
  include "../dnmd/include/connect.php";
  if(!isset($_SESSION['ses_userid']) || $_SESSION['ses_userid'] != 'admin'){

    ?>
    <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo "./main.php"?>");
    </script>
    <?php
  } ?>

  <html>
    <head>
      <meta charset="utf-8">
      <title>D.NMD</title>
      <link rel="stylesheet" href="./css/normalize.css" />
      <link rel="stylesheet" href="./css/register.css?a"/>

    </head>

    <body>
      <h1><div style="text-align:center">D.NMD</div></h1>
      <h4><div style="text-align:center">수업등록</div></h4>

      <div id="register">
        <form action="./register_update.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="size" value="1000000">
          <table id="register" align=center>

            <tbody>

              <tr>
                <th scope="row"><label for="title">수업명</label></th>
                <td class="title"><input type="text" name="title" id="title"></td>
              </tr>

              <tr>
                <th scope="row"><label for="teacher">강사</label></th>
                <td class="teacher"><input type="text" name="teacher" id="teacher"></td>
              </tr>

              <tr>
                <th scope="row"><label for="date">일자</label></th>
                <td class="date"><input type="text" name="date" id="date"></td>
              </tr>

              <tr>
                <th scope="row"><label for="time">시간</label></th>
                <td class="time"><input type="text" name="time" id="time"></td>
              </tr>

              <tr>
                <th scope="row"><label for="place">장소</label></th>
                <td class="place"><input type="text" name="place" id="place"></td>
              </tr>

              <tr>
                <th scope="row"><label for="peoples">인원</label></th>
                <td class="peoples">0 - <input type="text" name="peoples" id="peoples"> 명</td>
              </tr>

              <tr>
                <th scope="row"><label for="charge">비용</label></th>
                <td class="charge"><input type="text" name="charge" id="charge"> 원</td>
              </tr>

              <tr>
                <th scope="row"><label for="content">수업내용</label></th>
                <td class="content"><textarea name="content" id="content"></textarea></td>
              </tr>

              <tr>
                <th scope="row"><label for="image">이미지</label></th>
                <td class="image"><input type="file" name="image" id="image"></td>
              </tr>

            </tbody>

          </table>

          <div class="btnSet">
            <button type="submit" class="btnSubmit btn">등록</button>
            <button type="button" class="view_btn1" onclick="location.href='./main.php'">메인으로</button>
          </div>

        </form>
      </div>
    </body>

  </html>
