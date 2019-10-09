<?php

	$sql = 'select * from comment where num=' . $no;

	$result = $connect->query($sql);

	$row = $result -> fetch_assoc();

	if(isset($row)) {

?>

<div id="commentView">

	<form action="comment_update.php" method="post">

		<input type="hidden" name="no" value="<?php echo $no?>">

			<div class="commentInfo">
        <table width=720 border=0 cellpadding=2 cellspacing=1 bgcolor=#777777 align=center style="margin-bottom:30px">

        <tr>
          <td height=30 colspan="4" bgcolor=#AD8EDB align=center>
            <font color=white><B>답변 완료</B></font>
        </tr>

				<?php

				$query = "select *from member where memberId = '$ses_userid'";
				$res = $connect -> query($query);
				$ro = mysqli_fetch_assoc($res); ?>

        <tr>
          <td width=100 height=30 align=center bgcolor=#E8D9FF>작성자</td>
          <td width=240 bgcolor=white><?php echo "관리자"?></td>
          <td width=100 height=30 align=center bgcolor=#E8D9FF>작성일</td>
          <td width=240 bgcolor=white><?php echo $row['co_date']?></td>
        </tr>

        <tr>
          <td bgcolor=white colspan=4>
          <font color=black>
          <pre><?php echo $row['co_content']?></pre>
          </font>
          </td>
        </tr>

        <?php

        if('admin' == $_SESSION['ses_userid']){ ?>

          <tr>
            <td bgcolor=white colspan=4 align=right>
            <button type="button" class="view_btn1" onclick="document.getElementById('hiddenContent').style.display=(document.getElementById('hiddenContent').style.display=='block') ? 'none' : 'block';">수정</button>
					</tr>

        <?php } ?>

      </table>

			</div>

			<div id="hiddenContent" class="example01" style="display: none;">

				<table width=720 border=0 cellpadding=2 cellspacing=1 bgcolor=#777777 align=center>

			  <tr>
			    <td height=30 colspan="4" bgcolor=#AD8EDB align=center>
			      <font color=white><B>수정 하기</B></font>
			  </tr>

			</table>

			<textarea name="coContent_modify" id="coContent_modify" style="width:710px; height:300px; margin-top:5px"><?php echo $row['co_content']?></textarea>

				<div class="btnSet" style="margin-bottom:10px; margin-top:10px">

					<input type="submit" value="수정 완료">

				</div>

			</div>

	</form>

</div>

<?php } else {

	if('admin' == $_SESSION['ses_userid']) { ?>

<form action="comment_update.php" method="post">

	<input type="hidden" name="no" value="<?php echo $no?>">
	<input type="hidden" name="coId" value="<?php echo $ro['name']?>">

  <table width=720 border=0 cellpadding=2 cellspacing=1 bgcolor=#777777 align=center>

  <tr>
    <td height=30 colspan="4" bgcolor=#AD8EDB align=center>
      <font color=white><B>답변 하기</B></font>
  </tr>

</table>

<textarea name="coContent" id="coContent" style="width:710px; height:300px; margin-top:5px"></textarea>

	<div class="btnSet" style="margin-bottom:10px; margin-top:10px">

		<input type="submit" value="답변 완료">

	</div>

</form>

<?php } } ?>
