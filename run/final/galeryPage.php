<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-galeryPage.css">
	<!------------------PLUGINS------------------>
	<!-------BOOSTRAP------>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<!-------ICON------>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Galery</title>
</head>
<body>

	<!-----------Google analitics----------->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-SC930026W4"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){window.dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-SC930026W4');
	</script>

	<div id="backDiv">
		<a href="javascript: window.history.back()" id="backButton"><i class="fa fa-long-arrow-left"></i> Wróć</a>
	</div>

	<div id="galeryDiv">
		<div class="container">
		  <!--filtering-->
			<div class="grid">
		    	<div class="grid-sizer col-xs-12 col-sm-6 col-md-4 col-lg-4"></div>
			    <div class="col-xs-12 col-sm-6 col-md-4 grid-item people">
			    	<img class="thumbnail img-responsive" src="images/pobrane1.jpeg" alt="">
			    </div>
			    <div class="col-xs-12 col-sm-6 col-md-4 grid-item people">
			    	<img class="thumbnail img-responsive" src="images/pobrane2.jpeg" alt="">
			    </div>
			    <div class="col-xs-12 col-sm-6 col-md-4 grid-item people">
			    	<img class="thumbnail img-responsive" src="images/pobrane3.webp" alt="">
			    </div>
			    <div class="col-xs-12 col-sm-6 col-md-4 grid-item people">
			    	<img class="thumbnail img-responsive" src="images/pobrane4.jpeg" alt="">
			    </div>
			    <div class="col-xs-12 col-sm-6 col-md-4 grid-item nature">
			    	<img class="thumbnail img-responsive" src="images/pobrane5.jpeg" alt="">
			    </div>
			    <div class="col-xs-12 col-sm-6 col-md-4 grid-item people">
			    	<img class="thumbnail img-responsive" src="images/pobrane6.jpeg" alt="">
			    </div>
			    <div class="col-xs-12 col-sm-6 col-md-4 grid-item people">
			    	<img class="thumbnail img-responsive" src="images/pobrane7.jpeg" alt="">
			    </div>
		  	</div>
		</div>
	</div>



	<!----plugins to gallery----->
	<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
	<script src='https://npmcdn.com/isotope-layout@3.0/dist/isotope.pkgd.min.js'></script>
	<script src='https://cdn.jsdelivr.net/prettyphoto/3.1.6/js/jquery.prettyPhoto.js'></script><script  src="js/script-galleryPage.js"></script>
</body>
</html>