<?php //создание каталога
 function showdir($dirName) {
	$f = scandir($dirName);
	$listFiles = [];
	$listDirs = [];
	foreach ( $f as $fileName ) {
		if ( ($fileName=='.') || ($fileName=='..') )
			continue;
			
		$pathToFile = "$dirName/$fileName";
		if (is_file($pathToFile))
			$listFiles[] = $fileName;
		if (is_dir($pathToFile))
			$listDirs[] = $fileName;
	};
	sort($listFiles);
	sort($listDirs);
	foreach ($listDirs as $dName) {
		echo "<div class='dir_closed file' rel='$dirName/$dName'>";
		echo "<img src='images/folder.png' class='folder'><div class='fileName'>$dName</div>";
		echo "</div>";
	}
	require_once('list-of-extentions.php');
	foreach ($listFiles as $fileName) {
		$src = getSrc($fileName);
		echo "<div class='file' rel='$dirName/$fileName'>";
		if(strlen($fileName) > 20) {
			$ext = explode(".", $fileName);
			$ext = end($ext);
			$fileName = substr($fileName, 0, 20 - strlen($ext) - 4) . '...' . $ext;
		} 
		echo "<img src='images/$src' class='icon'><div class='fileName'>$fileName</div>";
		echo "</div>";
	}
 };
 
?>