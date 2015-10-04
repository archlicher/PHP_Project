<?php 
$categories = $this->___data[0];
$products = $this->___data[1];
$promos = $this->___data[2];
?>
<div id="wrapper">
	<div class="container-fluid">
		<div class="col-lg-4 panel col-md-2 sidebar"> 
			<table class="table"><strong style="font-size:150%;">Categories:</strong>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Action</th>
				</tr>
			<?php
				foreach ($categories as $key => $value) {?>
					<tr>
						<td><?= $value['category_id'];?></td>
						<td><?= $value['name'];?></td>
						<td>
							<a class="btn" href="/php_project/application/public/editor/category/edit/<?= $value['category_id'];?>">Edit</a>
						</td>
					</tr>
			<?php } ?>
			<?php if ($_SESSION['admin']==true) {?>
				<tr>
					<td><a class="btn btn-success" href="/php_project/application/public/admin/category/add">Add new category</a></td>
				</tr>
			<?php } ?>
			</table>
			<table class="table"><strong style="font-size:150%;">Promotions:</strong>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Discount</th>
					<th>Action</th>
				</tr>
			<?php
				foreach ($promos as $key => $value) {?>
					<tr>
						<td><?= $value['promotion_id'];?></td>
						<td><?= $value['promotion_name'];?></td>
						<td>-<?= $value['discount'];?>%</td>
						<td>
							<a class="btn" href="/php_project/application/public/editor/promotion/edit/<?= $value['promotion_id'];?>">Edit</a>
						<?php if ($_SESSION['admin']==true) {?>
							<a class="btn" href="/php_project/application/public/admin/promotion/remove/<?= $value['promotion_id'];?>">Remove</a>
						<?php } ?>
						</tr>
			<?php } ?>
				<tr><td><a class="btn btn-success" href="/php_project/application/public/editor/promotion/add">Add new promotion</a></td></tr>
			</table>			
		</div>
		<div class="col-lg-8 panel"><strong style="font-size:150%;">Products:</strong>
			<table class="table">
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Promotion</th>
					<th>Action</th>
				</tr>
			<?php
				foreach ($products as $key => $value) {?>
					<tr>
						<td><?= $value['product_id'];?></td>
						<td><?= $value['name'];?></td>
						<td><?= $value['description'];?></td>
						<td><?= $value['price'];?></td>
						<td><?= $value['promotion_id'] != null ? $value['promotion_id'] : "no promo";?></td>
						<td>
							<a class="btn" href="/php_project/application/public/editor/product/edit/<?= $value['product_id'];?>">Edit</a>
							<a class="btn" href="/php_project/application/public/editor/product/promo/<?= $value['product_id'];?>">Add promotion</a>
							<?php if ($_SESSION['admin']==true) {?>
								<a class="btn" href="/php_project/application/public/admin/product/remove/<?= $value['product_id'];?>">Remove</a>
							<?php } ?>
						</td>
					</tr>
			<?php } ?>
			</table>
		</div>
	</div>
</div>