<?php 
$user = $this->___data;
?>
<div id="wrapper">
	<div class="container-fluid">
		<div class="form-horizontal" style="margin : auto; margin-top : 100px; width:400px;">
			<h3>Edit user:</h3>
			<form method="post">
				<input type="text" placeholder="Username" class="form-control" name="username" autofocus style="margin:15px;" value="<?= $user['username'];?>">
				<input type="email" placeholder="Email" class="form-control" name="email" autofocus style="margin:15px;" value="<?= $user['email'];?>"/>
				<input type="password" placeholder="New password" class="form-control" name="password" style="margin:15px;" value="<?= $user['password'];?>"/>
				<input type="text" placeholder="Type" class="form-control" name="type" autofocus style="margin:15px;" value="<?= $user['type'];?>">
				<input type="text" placeholder="Banned" class="form-control" name="banned" autofocus style="margin:15px;" value="<?= $user['banned'];?>">
				<input type="submit" class="btn btn-warning active" role="button" value="Edit profile" style="margin-left:15px;">
			</form>
		</div>
	</div>
</div>