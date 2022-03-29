function timer() {	
	var timeleft = 10;
	var downloadTimer = setInterval(function(){
	  	if(timeleft <= 0){
			clearInterval(downloadTimer);
	  	}
	  	timeleft -= 1;

	  	if(timeleft == 0) {
	  		$.ajax({
	  			method: "POST",
	  			url: 'viewCounter/upload-data.php',
	  			data: {view: timeleft},
	  			success: function(res) {
	  				return console.log(res);
	  			}
	  		});
	  	}

	}, 1000);
}

timer();