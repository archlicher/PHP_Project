<?php 
$user = $this->___data[0][0];
$products = $this->___data[1];
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
				<tr>
					<td><a class="btn" href="/php_project/application/public/user/profile/cash">Add cash</a></td>
				</tr>
			</table>
		</div>
		<?php if (count($products)>0) {?>
		<div class="col-lg-8 panel"> Products:
			<table class="table">
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Description</th>
					<th>Quntity</th>
					<th>Price</th>
					<th>Promotion</th>
				</tr>
			<?php
				foreach ($products as $key => $value) {?>
					<tr>
						<td><?= $value['product_id'];?></td>
						<td><?= $value['name'];?></td>
						<td><?= $value['description'];?></td>
						<td><?= $value['quantity'];?></td>
						<td><?= $value['price'];?></td>
						<td><?= $value['promotion'] != null ? $value['promotion'] : "no promo";?></td>
					</tr>
			<?php } ?>
			</table>
			<?php } else { echo '<div class="col-lg-8 panel"><h3>You have not bought any products</h3></div>';} ?>
		</div>
	</div>
</div>