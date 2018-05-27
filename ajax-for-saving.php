<?php
	if (isset($_POST)) {
		if (strpos($_POST['filename'], 'admin/')) {
			echo '<div id="message">У вас недостаточно прав на редактирование этого файла</div>';
		} else if (file_put_contents($_POST['filename'], $_POST['filetext'])) {
			echo '<div id="message">Файл успешно сохранен</div>';
		} else {
			echo '<div id="message">Ошибка сохранения файла</div>';
		}
	}
		
