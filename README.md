# archiveForSchool
Archive will be hold student arts

## Back button
Java Script have function with get last open page. I use this function to 
### code
```HTML
<a href="javascript: history.go(-1)">Back</a>
```


## Delete user
If you select student to delete and click delte button will show you confirm alert
### JS code
```JS
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
					//send value from cehckbox into PHP
					//in checkbox value be user_id
				    $.ajax({
				    	url: "../delete_data.php",
				     	method: "post",
				      	data: {user_id: getCheckBoxs[i].value},
				      	success: function() {
				        	return true;
				      	}
				    });
				}
			}
		}
	}	

}
```


## To do
- [x] create JSON file for classes and profies lists
- [ ] frontend for admin panel
- [x] add user button in <strong>searchPage.php</strong> table\
- [x] fix issue with AJAX
- [ ] find solution for unfresh page after delete user

