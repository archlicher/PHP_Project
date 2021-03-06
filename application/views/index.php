<div id="wrapper">
	<div class="container-fluid">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar"><strong style="font-size:150%;">Categories</strong>
			<?php
				$categories = $this->___data[0];
				foreach ($categories as $key => $value) {?>
					<li class="active"><a href="/php_project/application/public/products/category/<?=$value['category_id'];?>"><?=$value['name'];?></a></li>
			<?php } ?>
			</ul>
		</div>
		<div class="col-lg-8 panel"><strong style="font-size:150%;">Products:</strong>
			<table class="table">
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Description</th>
					<th>Quntity</th>
					<th>Price</th>
					<th>Promotion</th>
					<?php if (isset($_SESSION['userId'])) { ?>
					<th>Action</th>
					<?php } ?>
				</tr>
			<?php
				$products = $this->___data[1];
				foreach ($products as $key => $value) {?>
					<tr>
						<td><?= $value['product_id'];?></td>
						<td><?= $value['name'];?></td>
						<td><?= $value['desciption'];?></td>
						<td><?= $value['quantity'];?></td>
						<td><?= $value['price'];?></td>
						<td><?= $value['promotion_id'] != null ? "-".$value['discount']."%" : "no promo";?></td>
						<?php if (isset($_SESSION['userId'])) { ?>
						<td><a class="btn" href="/php_project/application/public/user/product/buy/<?=$value['product_id'];?>">Buy</a></td>
						<?php }?>
					</tr>
			<?php }
			?>
			</table>
		</div>
	</div>
</div>