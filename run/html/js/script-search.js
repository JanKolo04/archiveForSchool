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
				//create optgroup
				let optgroup = document.createElement('optgroup');
				//set class name
				optgroup.className = 'optgroup';
				//set label
				optgroup.label = keys;
				//append optgroup to select
				select.appendChild(optgroup);

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
