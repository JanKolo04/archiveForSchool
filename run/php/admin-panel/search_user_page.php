<?php

	function search_user_page() {
		echo "
			<form method='post'>
				<input type='text' name='searchInput'>
				<button type='submit' name='submitSearch'>Search</button>
			</form>
		";
	}

?>