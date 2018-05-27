<style>
	body { 
		background-image: url('images/bg.jpg');
		background-color: whitesmoke;
	}
	/* блоки-контейнеры */
	#content { display: flex }
	#catalog { 
		background-color: whitesmoke;
		margin-left: 30px; 
		flex-grow: 1; 
		flex-basis: 150px;
		border: 1px solid #434343;
	}
	.subdir { 
		margin-left: 20px;
		display: flex; 
		flex-direction: column; 
		justify-content: flex-start;
	}

	/* Форма для загрузки файлов */
	#loadform {
		padding-left: 10px;
		margin-top: 10px;
	}

	/* Иконки */
	.folder { width: 25; height: 25;}
	.icon { width: 20; height: 20; }
	.active_file { background: gainsboro; }
	#download { 
		order: 2;
		width: 20; 
		height: 20; 
		background-image: url('images/download.png'); 
		background-size: cover;
	}
	#save_name { 
		order:1;
		width: 20; 
		height: 20; 
		background-image: url('images/save.png'); 
		background-size: cover;
	}
	.delete { 
		position: fixed;
		left: 1px;
		top: 10px;
		margin-left: 10px;
		background-size: cover;
	}
	#delete_file {
		width: 20px;
		height: 20px;
		background-image: url('images/delete.png'); 
	}
	#delete_folder {
		width: 20px;
		height: 20px;
		background-image: url('images/delete_folder.png'); 
	}

	/*Блоки директорий и файлов*/
 	.dir_closed, .dir_opened {display: flex; align-items:flex-end;}
  	.file {display: flex; margin: 3px 0px 3px 3px; position: relative;}
	.fileName { flex: 100; }

	/* Просмотрщик содержимого файлов */
	#viewer {
		width: 600px;
		height: 400px;
		text-align: center;
		margin-left: 40px; 
		flex-grow: 3;
	}
	#img-view {
		max-width: 600px;
		max-height: 400px;
	}
	#filetext {
		width: 600px;
		height: 400px;
	}
	#message {
		background-color: whitesmoke;
		border: 1px solid #434343;
		padding: 10px;
	}
	#change_form {
		background-color: whitesmoke;
		border: 1px solid #434343;
		padding: 10px;
	}
</style>