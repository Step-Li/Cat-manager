<?php
	if(isset($_POST['name'])) {
		if(unlink($_POST['name'])) {
			echo 'success';
		} else echo 'nope';
	}