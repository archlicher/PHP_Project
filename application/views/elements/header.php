<div id="wrapper">
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-top:0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index">The Shopping Cart</a>
		</div>
		<ul class="nav navbar-nav">
		<?php 
		if (!empty($_SESSION['userId'])) {?>
			<li><a class="btn btn-default user-btn" href="user/profile"></a>Profile</li>
			<li><a class="btn btn-default user-btn" href="user/orders"></a>My cart</li>
			<li><a class="btn btn-default user-btn" href="user/products"></a>My products</li>
			<?php if($_SESSION['editor']) {?>
			<li><a class="btn btn-default user-btn" href="editor/edit"></a>Editor</li>
			<?php } 
			if($_SESSION['admin']) {?>
			<li><a class="btn btn-default user-btn" href="admin/modify"></a>Admin</li>
			<?php } ?>
		<?php } else { ?>
			<li><a class="btn btn-default user-btn" href="login/login">Login</a></li>
			<li><a class="btn btn-default user-btn" href="login/register">Register</a></li>
		<?php } ?>
		</ul>
	</nav>
</div>