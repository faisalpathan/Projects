<?php

$type = $_GET['cstype'];
$trans = $_GET['cstr'];

?>
<html>
	<head>

		<?php //wp_head(); ?>

		<script type="text/javascript">
			var CSSettings = {"pluginPath":"<?php echo $GLOBALS['csPluginPath'] ?>"};
		</script>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
		<script type="text/javascript" src="<?php echo $GLOBALS['csPluginPath'].'/js/cute.slider.js' ?>"></script>
		<script type="text/javascript" src="<?php echo $GLOBALS['csPluginPath'].'/js/cute.transitions.all.js'?>"></script>
		<script type="text/javascript" src="<?php echo $GLOBALS['csPluginPath'].'/js/cute.transitions.all.js' ?>"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
		<link rel='stylesheet' href="<?php echo $GLOBALS['csPluginPath'].'/css/cuteslider.css' ?>">

		<script type="text/javascript">

			// Type
			var trtype = '<?php echo $type ?>';

			// 3D support?
			if( trtype == '3d' && !jQuery('html').hasClass('canvas') && !jQuery('html').hasClass('csstransforms3d') ) {
				var cute_supported = false;
				document.write('Your browser doesn\'t support 3D transitions');
			} else {
				var cute_supported = true;
			}


		</script>

		<style>

			html, body {
				margin: 0px !important;
				padding: 0px;
				overflow: hidden;
			}

			* html body {
				margin: 0px !important;
			}

			#wrapper{
				width: 290px;
				margin: 0px auto;
			}

			#my-cute-slider{
				width: 290px;
				height: 150px;
				position: relative;
			}
		</style>
	</head>
	<body>

		<div id="wrapper" class="wrapper" >
			<div id="my-cute-slider" class="cute-slider" data-width="290" data-height="150" data-force="<?php echo $type; ?>">
				<ul data-type="slides">
					<li data-delay="0.5" data-trans3d="tr<?php echo $trans ?>" data-trans2d="tr<?php echo $trans ?>">
						<img src="<?php echo $GLOBALS['csPluginPath'].'/img/preview/1.png' ?>">
					</li>
					<li data-delay="0.5" data-trans3d="tr<?php echo $trans ?>" data-trans2d="tr<?php echo $trans ?>">
						<img src="<?php echo $GLOBALS['csPluginPath'].'/img/blank.png' ?>" data-src="<?php echo $GLOBALS['csPluginPath'].'/img/preview/2.png' ?>">
					</li>
					<li data-delay="0.5" data-trans3d="tr<?php echo $trans ?>" data-trans2d="tr<?php echo $trans ?>">
						<img src="<?php echo $GLOBALS['csPluginPath'].'/img/blank.png' ?>" data-src="<?php echo $GLOBALS['csPluginPath'].'/img/preview/3.png' ?>">
					</li>
					<li data-delay="0.5" data-trans3d="tr<?php echo $trans ?>" data-trans2d="tr<?php echo $trans ?>">
						<img src="<?php echo $GLOBALS['csPluginPath'].'/img/blank.png' ?>" data-src="<?php echo $GLOBALS['csPluginPath'].'/img/preview/4.png' ?>">
					</li>
				</ul>
				<ul data-type="controls"></ul>
			</div>
		</div>

		<script type="text/javascript">
			if(cute_supported == true) {
				var myslider = new Cute.Slider();
				myslider.setup("my-cute-slider" , "wrapper", "<?php $GLOBALS['csPluginPath'].'/skins/borderlesslight/style/slider-style.css' ?>");
			} else {
				jQuery('#wrapper').hide();
			}
		</script>
	</body>
</html>