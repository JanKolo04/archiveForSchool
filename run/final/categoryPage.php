<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-categoryPage.css">

	<!------------------PLUGINS------------------>
	<!-------BOOSTRAP------>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<!-------ICON------>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Category</title>
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

	<div id="categoryDiv">
		<div class="container">
			<div class="row d-flex justify-content-around">
		    	<div class="longCol" id="newWorks" onclick="location.href='index.php?page=galeryPage';">Najnowsze prace</div>

		    	<div class="longCol" onclick="location.href='index.php?page=contestPage';">Konkursy i Wystawy</div>

		    	<div class="longCol" onclick="location.href='index.php?page=searchPage&all=true';">Lista prac</div>
		  	</div>
		</div>
	</div>


</body>
</html>








