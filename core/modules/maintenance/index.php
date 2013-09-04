<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=7" />
	<title><?php echo __('System in maintenance') ?> - <?php Wordwebpress::getInstance()->helper()->helper('title')?></title>
	<style type="text/css">
		html, body {
			margin: 0;
			padding: 0;
			width: 100%;
			height: 100%;
			background: url("<?php echo Wordwebpress::getInstance()->html()->get_image_url('bg.jpg') ?>") no-repeat center center;
			text-align: center;
		}
		a {
			color: #222;
		}
	</style>
</head>
<body>
	<?php $img = Wordwebpress::getInstance()->html()->get_image_url('maintenance.png'); ?>
	<img src="<?php echo ( $img === false ? Wordwebpress::getInstance()->modules()->get_module_path('maintenance') . '/default.png' : $img ); ?>" alt="<?php echo __('System in maintenance');?>"/><br />
	<p>&nbsp;</p>
	<a href="<?php bloginfo('url') ?>/wp-login.php?preview">
		<?php echo __('Administration')?><br />
	</a>
	<p>&nbsp;</p>
	<a href="<?php echo Wordwebpress::getInstance()->configuration()->get_cfn_value('developer_link') ?>" target="_blank" title="<?php echo __('Site of the development')?>">
		<img src="<?php echo Wordwebpress::getInstance()->configuration()->get_cfn_value('developer_logo') ?>" alt="<?php echo __('Site of the development')?>" border="0" />
	</a>
</body>
</html>