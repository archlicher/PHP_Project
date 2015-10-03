<?php 
	$product = $this->___data;
?>
<div id="wrapper">
	<div class="container-fluid">
		<div class="form-horizontal" style="margin : auto; margin-top : 100px; width:400px;">
			<h3>Product info:</h3>
			<form method="post">
				<input type="text" placeholder="Name" class="form-control" name="name" required autofocus style="margin:15px;" value="<?= $product['name'];?>"/>
				<input type="text" placeholder="Description" class="form-control" name="description" required style="margin:15px;" value="<?= $product['desciption'];?>"/>
				<input type="text" placeholder="Price" class="form-control" name="price" required style="margin:15px;" value="<?= $product['price'];?>"/>
				<input type="text" placeholder="quantity" class="form-control" name="quantity" required style="margin:15px;"  value="<?= $product['quantity'];?>"/>
				<input type="submit" class="btn btn-danger active" role="button" value="Edit product" style="margin-left:15px;">
			</form>
		</div>
	</div>
</div>