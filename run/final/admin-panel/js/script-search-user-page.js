function delete_user() {
	//get all checkbox from table
	let getCheckBoxs = document.querySelectorAll(".check");
	//variable to check whether checked check box exist
	let checker = false;
	//loop to get all elements from selector
	for(let i=0; i<getCheckBoxs.length; ++i) {
		//if checked checkbox exist change variable to true and break loop
		if(getCheckBoxs[i].checked) {
			checker = true;
			break;
		}
	}
	//if checker equals true do code
	if(checker == true) {
		//show confirm alert
		let confirmAlert = confirm("Are you want delete this user?");
		//if confirm alert return true do code
		if(confirmAlert == true) {
			console.log("siema");
			//get all elements from selector
			for(let i=0; i<getCheckBoxs.length; ++i) {
				//if checkbox is checked send POST to PHP file
				if(getCheckBoxs[i].checked) {
					let valueFromCheckBox = getCheckBoxs[i].value;
					//send value from cehckbox into PHP
					//in checkbox value be user_id
				    $.ajax({
				    	type: "POST",
				    	url: "delete_data.php",
				      	data: {user_id: valueFromCheckBox},
				      	success: function(data) {
				        	return console.log(data);
				      	}
				    });
				}
			}
		}
	}
}