<?php 
$categories = $this->___data[0];
$products = $this->___data[1];
?>
<div id="wrapper">
	<div class="container-fluid">
	<?php if (count($categories)>0) {?>
		<div class="col-lg-8 panel"> Products:
			<table class="table">
				<tr>
					<th>Id</th>
					<th>Name</th>
				</tr>
			<?php
				foreach ($categories as $key => $value) {?>
					<tr>
						<td><?= $value['category_id'];?></td>
						<td><?= $value['name'];?></td>
						<td><a class="btn" href="/php_project/application/public/editor/category/edit/<?= $value['category_id'];?>">Edit</a></td>
					</tr>
			<?php } ?>
			</table>
		</div>
	<?php } ?>
	<?php if (count($products)>0) {?>
		<div class="col-lg-8 panel"> Products:
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
						<td><?= $value['promotion'] != null ? $value['promotion'] : "no promo";?></td>
						<td>
							<a class="btn" href="/php_project/application/public/editor/product/edit/<?= $value['product_id'];?>">Edit</a>
							<a class="btn" href="/php_project/application/public/editor/product/promo/<?= $value['product_id'];?>">Add promotion</a>
						</td>
					</tr>
			<?php } ?>
			</table>
		</div>
	<?php } ?>
	</div>
</div>