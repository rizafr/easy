<html>
<head>
	<meta http-equiv="Content-Script-Type" content="image/jpeg">
	<style type="text/css">
	* {
		margin: 0;
		padding: 0;
	}
	.image {
		width: <?php echo $width; ?>;
		height: <?php echo $height; ?>;
		background-image: url('<?php echo $file; ?>');
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
	</style>
</head>
<body>
	<div class="image"></div>
</body>
</html>