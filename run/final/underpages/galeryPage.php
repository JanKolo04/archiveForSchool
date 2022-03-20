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

	<div id="baner">
		<div id="divLogo">
			<a href="mainPage.html"><img id="logo" src="../images/logoZSK.png"></a>
		</div>
	</div>

	<div id="backDiv">
		<a href="categoryPage.php" id="backButton"><i class="fa fa-long-arrow-left"></i> Wróć</a>
	</div>

	<div id="main">
		<div id="galeryDiv">
			<div class="container">
			  <!--filtering-->
				<div class="grid">
			    	<div class="grid-sizer col-xs-12 col-sm-6 col-md-4 col-lg-4"></div>
				    <div class="col-xs-12 col-sm-6 col-md-4 grid-item people">
				    	<img class="thumbnail img-responsive" src="../images/pobrane1.jpeg" alt="">
				    </div>
				    <div class="col-xs-12 col-sm-6 col-md-4 grid-item people">
				    	<img class="thumbnail img-responsive" src="../images/pobrane2.jpeg" alt="">
				    </div>
				    <div class="col-xs-12 col-sm-6 col-md-4 grid-item people">
				    	<img class="thumbnail img-responsive" src="../images/pobrane3.webp" alt="">
				    </div>
				    <div class="col-xs-12 col-sm-6 col-md-4 grid-item people">
				    	<img class="thumbnail img-responsive" src="../images/pobrane4.jpeg" alt="">
				    </div>
				    <div class="col-xs-12 col-sm-6 col-md-4 grid-item nature">
				    	<img class="thumbnail img-responsive" src="../images/pobrane5.jpeg" alt="">
				    </div>
				    <div class="col-xs-12 col-sm-6 col-md-4 grid-item people">
				    	<img class="thumbnail img-responsive" src="../images/pobrane6.jpeg" alt="">
				    </div>
				    <div class="col-xs-12 col-sm-6 col-md-4 grid-item people">
				    	<img class="thumbnail img-responsive" src="../images/pobrane7.jpeg" alt="">
				    </div>
			  	</div>
			</div>
		</div>


		<footer id="footer">
			<div id="infoDiv">
				<p><strong>Administrator</strong><br>
				Filip Mozol<br>
				fmozol@technikumkreatywne.pl</p>
			</div>

			<div  id="autorAndIconsDiv">
				<div id="autorDiv">
					<p id="autor"><strong>Autor Jan Kołodziej</strong></p>
				</div>

				<div id="iconsDiv">
					<a href="https://www.facebook.com/SzkolyKreatywne"><img src="../images/icons/facebook.png"></a>
					<a href=""><img src="../images/icons/instagram.png"></a>
					<a href="https://szkolykreatywne.pl/"><img src="../images/icons/google.png"></a>
					<a href=""><img src="../images/icons/youtube.png"></a>
				</div>
			</div>
		</footer>
	</div>


	<!----plugins to gallery----->
	<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
	<script src='https://npmcdn.com/isotope-layout@3.0/dist/isotope.pkgd.min.js'></script>
	<script src='https://cdn.jsdelivr.net/prettyphoto/3.1.6/js/jquery.prettyPhoto.js'></script><script  src="js/script-galleryPage.js"></script>
</body>
</html>