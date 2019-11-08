<?php

	$sql = "SELECT *FROM comment WHERE num='$no'";
	$row = mysqli_fetch_assoc($connect->query($sql));

	// 이미 답변한 내용이 있을 경우,
	if(isset($row)) {
?>
	<form action="comment_update.php" method="post">

		<input type="hidden" name="no" value="<?php echo $no?>">
		<input type="hidden" name="coId" value="admin">

		<div class="panel panel-info" style="margin-top:40px">
			<div class="panel-heading text-center">답변 완료</div>

			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
						<td><p>작성자 : 관리자</p></td>
						<td><p class="text-right">작성일 : <?=$row['co_date']?></p></td>
						</tr>
					</thead>
					<tbody>
						<td colspan="2"><p style="margin-top: 20px"><?=$row['co_content']?></p></td>
					</tbody>
				</table>
			</div>
		</div>

			<?php 
		
			// 관리자로 로그인한 경우 수정 버튼 보여주기
			if($_SESSION['ses_userid'] === 'admin') { ?>

			<div class="text-right" style="margin-bottom:30px">
				<button type="button" class="btn btn-default" onclick="document.getElementById('hiddenContent').style.display=(document.getElementById('hiddenContent').style.display=='block') ? 'none' : 'block';">답변 수정</button>
			</div>

			<?php 
			}
			?>

		
		<!-- 수정버튼 이벤트 -->
		<div id="hiddenContent" style="display: none">
			<div class="panel panel-warning">
				<div class="panel-heading text-center">답변 수정</div>

				<div class="panel-body">
					<textarea id="coContent_modify" rows="15px" class="form-control" name="coContent_modify" require autofocus><?php echo $row['co_content']?></textarea>
				</div>
			</div>

			<div class="text-right" style="margin-bottom:30px">
				<input type="submit" class="btn btn-warning" value="수정 완료">
			</div>
		</div>

	</form>

	<?php
	} else {
		
		if($_SESSION['ses_userid'] === 'admin') { ?>

			<form action="comment_update.php" method="post">

				<input type="hidden" name="no" value="<?php echo $no?>">
				<input type="hidden" name="coId" value="admin">

				<div class="panel panel-info">
					<div class="panel-heading text-center">답변 하기</div>
					<div class="panel-body">
						<textarea id="coContent" rows="15px" class="form-control" name="coContent" require autofocus></textarea>
					</div>
				</div>
				<div class="text-right" style="margin-bottom:30px">
					<input type="submit" class="btn btn-info" value="답변 완료"">
				</div>

			</form>
		<?php
		}
	}
	?>

