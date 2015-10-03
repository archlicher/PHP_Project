<?php
	$promos = $this->___data;
?>
<div id="wrapper">
	<div class="container-fluid">
		<div class="form-horizontal" style="margin : auto; margin-top : 100px; width:400px;">
			<h3>Add promotion to product:</h3>
			<form method="post">
				<?php foreach ($promos as $key => $value) {?>
				<input type="radio" name="name" value="<?= $value['name'];?>" checked/> <label for="name" style="font-size:150%;"><?= $value['name'];?></label>
				<br/>
				<?php }?>
				<input type="submit" class="btn-sm btn-danger active" role="button" value="Add promotion">
			</form>
		</div>
	</div>
</div>