<div id="wrapper">
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/php_project/application/public/">The Shopping Cart</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
			<?php 
			if (!empty($_SESSION['userId'])) {?>
				<li><a href="/php_project/application/public/user/profile">Profile</a></li>
				<li><a href="/php_project/application/public/user/product/cart">My cart</a></li>
				<?php if($_SESSION['editor'] || $_SESSION['admin']) {?>
				<li><a href="/php_project/application/public/editor/index">Editor</a></li>
				<?php } 
				if($_SESSION['admin']) {?>
				<li><a href="/php_project/application/public/admin/index">Admin</a></li>
				<?php } ?>
				<li><a href="/php_project/application/public/user/auth/logout">Logout</a></li>
			<?php } else { ?>
				<li><a href="/php_project/application/public/user/auth/login">Login</a></li>
				<li><a href="/php_project/application/public/user/auth/register">Register</a></li>
			<?php } ?>
			</ul>
		</div>
	</nav>
</div>