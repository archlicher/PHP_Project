<?php 
$users = $this->___data;
?>
<div id="wrapper">
	<div class="container-fluid">
		<div class="col-lg-8 panel"><strong style="font-size:150%;">Users:</strong>
			<table class="table">
				<tr>
					<th>Id</th>
					<th>Username</th>
					<th>Password</th>
					<th>Email</th>
					<th>Type</th>
					<th>Banned</th>
					<th>Action</th>
				</tr>
			<?php
				foreach ($users as $key => $value) {?>
					<tr>
						<td><?= $value['user_id'];?></td>
						<td><?= $value['username'];?></td>
						<td><?= $value['password'];?></td>
						<td><?= $value['email'];?></td>
						<td><?= $value['type'];?></td>
						<td><?= $value['banned']==0 ? "no" : "yes";?></td>
						<td>
							<a class="btn" href="/php_project/application/public/admin/user/edit/<?= $value['user_id'];?>">Edit</a>
							<a class="btn" href="/php_project/application/public/admin/user/ban/<?= $value['user_id'];?>">Ban</a>
						</td>
					</tr>
			<?php } ?>
			</table>
		</div>
	</div>
</div>