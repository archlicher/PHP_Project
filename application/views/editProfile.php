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
					<td><a class="btn" href="/php_project/application/public/user/profile/cash">Add cash</a></td>
				</tr>
			</table>
		</div>
		<div class="form-horizontal" style="margin : auto; margin-top : 100px; width:400px;">
			<h3>Edit profile:</h3>
			<form method="post">
				<input type="email" placeholder="Email" class="form-control" name="email" autofocus style="margin:15px;"/>
				<input type="password" placeholder="New password" class="form-control" name="password" style="margin:15px;"/>
				<input type="password" placeholder="Confirm password" class="form-control" name="confirmPassword" style="margin:15px;"/>	
				<input type="submit" class="btn btn-warning active" role="button" value="Edit profile" style="margin-left:15px;">
			</form>
		</div>
	</div>
</div>