<?php

	function get_mac_addresses() {
		$ip = $_SERVER['REMOTE_ADDR'];
		

		echo "IP addresses: $ip";

	}

	get_mac_addresses();


?>