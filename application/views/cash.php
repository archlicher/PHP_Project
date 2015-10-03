<?php 
$user = $this->___data[0];
?>
<div id="wrapper">
	<div class="container-fluid">
		<div class="col-sm-3 col-md-2 sidebar panel">User info:
			<table class="nav nav-sidebar table">
				<tr>
					<th>Username:</td>
					<td><?=$user['username'];?></td>
				</tr>
				<tr>
					<th>Email:</td>
					<td><?=$user['email'];?></td>
				</tr>
				<tr>
					<th>Cash:</td>
					<td><?=$user['cash'];?></td>
				</tr>
				<tr>
					<td><a class="btn" href="/php_project/application/public/user/profile/edit">Edit profile</a></td>
				</tr>
			</table>
		</div>
		<div class="form-horizontal" style="margin : auto; margin-top : 100px; width:400px;">
			<h3>Add cash:</h3>
			<form method="post">
				<input type="text" placeholder="cash" class="form-control" name="cash" required autofocus style="margin:15px;"/>
				<input type="password" placeholder="Password" class="form-control" name="password" required style="margin:15px;"/>	
				<input type="submit" class="btn btn-info active" role="button" value="Add cash" style="margin-left:15px;">
			</form>
		</div>
	</div>
</div>