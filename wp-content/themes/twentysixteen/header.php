<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<!-- Basic page needs
	============================================ -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Coupn</title>
	<meta name="description" content="">

	<!-- Mobile specific metas
	============================================ -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Fonts
	============================================ -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700' rel='stylesheet' type='text/css'>

	<!-- Favicon
	============================================ -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('stylesheet_directory') ?>/img/favicon.ico">

	<!-- CSS  -->

	<!-- master CSS
	============================================ -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/css/animate.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/css/meanmenu.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/lib/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/css/style.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/css/responsive.css">


	<!-- modernizr js
	============================================ -->
	<script src="<?php bloginfo('stylesheet_directory') ?>/js/vendor/modernizr-2.8.3.min.js"></script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Add your site or application content here -->

<!-- header start -->
<header>
	<!-- header-area start -->
	<div id="sticker" class="header-area">
		<div class="container">
			<div class="row">
				<!-- logo start -->
				<div class="col-md-2 col-lg-2">
					<div class="logo">
						<a href="index.html"><img src="<?php bloginfo('stylesheet_directory')?>/img/images/logo.svg" alt="" /></a>
					</div>
				</div>
				<!-- logo end -->
				<!-- mainmenu start -->
				<div class="col-md-11 col-lg-10  ">
					<div class="header-search">
						<form action="#">
							<span class="search-button"><i class="fa fa-search"></i></span>
							<input type="text" placeholder="search..."/>
						</form>
					</div>
					<div class="mainmenu">
						<nav>
							<ul id="nav">
								<li><a href="#">ABOUT US</a>
									<ul class="sub-menu">
										<li><a href="index-2.html">Homepage Version 2</a></li>
										<li><a href="index-3.html">Homepage Version 3</a></li>
										<li><a href="index-4.html">Homepage Version 4</a></li>
									</ul>
								</li>
								<li><a href="#">SOLUTION</a></li>

								</li>
								<li><a href="#">FEATURES</a>

								</li>
								<li><a href="#">PRICING</a>

								</li>
								<li><a href="#">PARTNERS</a>

								</li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- mainmenu end -->
			</div>
		</div>
	</div>
	<!-- header-area end -->
	<!-- mobile-menu-area start -->
	<div class="mobile-menu-area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="mobile-menu">
						<div class="logo">
							<a href="index.html"><img src="<?php bloginfo('stylesheet_directory') ?>/img/images/logo.svg" alt="" /></a>
						</div>
						<nav id="dropdown">
							<ul>
								<li><a href="#">ABOUT US</a>
									<ul>
										<li><a href="#">Home 2</a></li>
										<li><a href="#">Home 3</a></li>
										<li><a href="#">Home 4</a></li>
									</ul>
								</li>
								<li><a href="#">SLOUTION</a></li>

								</li>
								<li><a href="#">FEATURES</a></li>
								<li><a href="#">PRICING</a>

								</li>
								<li><a href="#">PARTNERS</a>

								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- mobile-menu-area end -->
</header>