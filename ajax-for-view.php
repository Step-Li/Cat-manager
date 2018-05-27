<?php
	$pathToFile = $_GET['file'];
	if(is_dir($pathToFile)) {
		exit;
	}
	$ext = pathinfo($pathToFile, PATHINFO_EXTENSION);
	$listOfImgs = ['jpg', 'jpeg', 'bmp', 'gif', 'png'];
	$listOfTexts = ['txt', 'css', 'js', 'php', 'html'];

	if (in_array($ext, $listOfImgs)) {
		echo "<div id='message'><img id='img-view' src='$pathToFile'></img></div>";
	} else if (in_array($ext, $listOfTexts)) {
		$content = file_get_contents($_GET['file']);

		$str = 
		"<form enctype='multipart/form-data' id='change_form' method='post'>
	    	<textarea id='filetext' name='filetext'>$content</tex" . "tarea>
	    	<input type='hidden' name='filename' value='$pathToFile'><p>
	    	<input id='save_changes' type='submit' value='Сохранить' />
		</form>";

		echo $str;
	}