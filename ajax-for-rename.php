<?php
	if(isset($_POST['newName']) & isset($_POST['oldName'])) {
		if(rename($_POST['oldName'], $_POST['newName'])) {
			echo 'true';
		} else echo 'false';
	} else echo 'ytn';