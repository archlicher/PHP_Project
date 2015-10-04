<?php 
	$category = $this->___data;
?>
<div id="wrapper">
	<div class="container-fluid">
		<div class="form-horizontal" style="margin : auto; margin-top : 100px; width:400px;">
			<h3>Category info:</h3>
			<form method="post">
				<input type="text" placeholder="Name" class="form-control" name="name" required autofocus style="margin:15px;" value="<?= $category['name'];?>"/>
				<input type="submit" class="btn btn-danger active" role="button" value="Edit category" style="margin-left:15px;">
			</form>
		</div>
	</div>
</div>