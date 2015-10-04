<?php 
	$promotion = $this->___data;
?>
<div id="wrapper">
	<div class="container-fluid">
		<div class="form-horizontal" style="margin : auto; margin-top : 100px; width:400px;">
			<h3>Category info:</h3>
			<form method="post">
				<input type="text" placeholder="Name" class="form-control" name="promotion_name" autofocus style="margin:15px;" value="<?= $promotion['promotion_name'];?>"/>
				<input type="text" placeholder="Disount" class="form-control" name="discount" autofocus style="margin:15px;" value="<?= $promotion['discount'];?>"/>
				<input type="submit" class="btn btn-danger active" role="button" value="Edit category" style="margin-left:15px;">
			</form>
		</div>
	</div>
</div>