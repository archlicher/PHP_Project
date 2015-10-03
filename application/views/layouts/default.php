<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../public/css/bootstrap-3.3.4-dist/css/bootstrap.css">
	<title>Document</title>
</head>
<body>
	<header>
		<?php include_once '../views/elements/header.php'; ?>
	</header>
	<?= $this->getLayoutData('body');?>
	<footer>
		<?php include_once '../views//elements/footer.php'; ?>
	</footer>
</body>
</html>