function insert_class_to_select() {
	//select
	let select = document.querySelector('#class');
	let jsonFile = new Request("JSON-files/class.json");
	//get data from JSON file
	fetch(jsonFile)
		.then(function(resp) {
			//return JS Object
			return resp.json();
		})
		//get data from Object
		.then(function(data) {
			for(keys in data) {
				//create disabled option
				let disabledOption = document.createElement('option');
				//set class name
				disabledOption.className = 'disabledOption';
				//set attribute
				disabledOption.setAttribute('disabled', 'disabled');
				//set innerHTML
				disabledOption.innerHTML = keys;
				//append disabledOption to select
				select.appendChild(disabledOption);

				for(value in keys) {
					if(data[keys][value]!== undefined) {
						//create option
						let option = document.createElement('option');
						//set class name
						option.className = 'option';
						//set innerHTML
						option.innerHTML = data[keys][value];
						//append option to select
						select.appendChild(option);	
					}		
				}
			}
			
		});
}

window.onload = function() {
	insert_class_to_select();
}
