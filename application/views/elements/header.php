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
				<li><a href="profile">Profile</a></li>
				<li><a href="orders">My cart</a></li>
				<li><a href="products">My products</a></li>
				<?php if($_SESSION['editor']) {?>
				<li><a href="edit">Editor</a></li>
				<?php } 
				if($_SESSION['admin']) {?>
				<li><a href="modify">Admin</a></li>
				<?php } ?>
				<li><a href="auth/logout">Logout</a></li>
			<?php } else { ?>
				<li><a href="user/auth/login">Login</a></li>
				<li><a href="user/auth/register">Register</a></li>
			<?php } ?>
			</ul>
		</div>
	</nav>
</div>