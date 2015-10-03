<ul>
<?php 
	foreach ($this->___data as $key => $value) {
		foreach ($value as $k => $v) { 
			if ($k == 'category_id') continue;?>
			<li><a href="\products\category\<?=$v;?>"><?=$v;?></a></li>
		<?php }
	}
?>
</ul>