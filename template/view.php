<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="template/css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="template/css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="template/css/colour.css" type="text/css" media="screen" charset="utf-8" />
	</head>
	<body>

		<h1 id="head">DTN Management</h1>

		<ul id="navigation">
			<?php
				foreach($menu as $k=>$v)
					if(isset($v['selected']) && $v['selected'])
						echo '<li><span class="active">'.$k.'</span></li>';
					else
						echo '<li><a href="'.$v['url'].'">'.$k.'</a></li>';
			?>
		</ul>
		
		<div id="content" class="container_16 clearfix">
			<?php echo $content; ?>
		</div>

			<div id="foot">
				<i>Developed by </i><a href="http://hognerud.net/">Michel Hognerud</a> | <i>Designed by </i><a href="http://mathew-davies.co.uk/">Mathew Davies</a>
			</div>
		
	</body>
</html>