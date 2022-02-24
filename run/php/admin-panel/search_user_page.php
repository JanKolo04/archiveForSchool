<?php

	function search_user_page() {
		echo "
			<form method='post'>
				<input type='text' name='searchInput' placeholder='Search user...'>
				<button type='submit' name='submitSearch'>Search</button>
			</form>
		";
	}

?>