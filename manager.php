<?php
    session_start();
    require_once('style.php');
?>

<script src="https://code.jquery.com/jquery-1.11.2.js"></script>

<script>

$(document).on('ready', function() {
	<?php
		require_once('libraries.php');
		require_once('loadfiles.php');
	?>
	$(document).on('click', '.dir_closed', function() {

		var dirPath = $(this).attr('rel');

		$(this).after('<div class="subdir">...</div>');
		var subdir = $(this).next('.subdir');
		
		$.ajax({
			type: 'GET',
			url: 'ajax-for-scandir.php',
			data: 'way=' + dirPath,
			success: function(data) { 
				subdir.html(data);

			}
		});	
		$(this).removeClass("dir_closed");
		$(this).addClass("dir_opened");
		$(this).children('img').attr('src', 'images/open-folder.png');
	});
	$(document).on('click', '.file', function() { 
		$('.active_file').removeClass('active_file');
		$(this).addClass('active_file');
		$('#download').remove();
		var name = $(this).attr('rel')
		if(!$(this).hasClass('dir_opened') & !$(this).hasClass('dir_closed')){
			$(this).append("<div id='download' rel='" + name +"'></div>");			
			$('.delete').remove();
			$(this).append("<div id='delete_file' class='delete' rel='" + name +"'></div>");
		} else {
			$('.delete').remove();
			$(this).append("<div id='delete_folder' class='delete' rel='" + name +"'></div>");
		}
		$(this).append("<div class='delete' rel='" + name +"'></div>");	
		$.ajax({
			type: 'GET',
			url: 'ajax-for-view.php',
			data: 'file=' + name,
			success: function(data) { 
				$('#viewer').html(data);

			}
		});	
	});
	$(document).on('submit', '#change_form', function(e) {
		e.stopPropagation(); 
		e.preventDefault(); 
		var changeForm = new FormData($('#change_form').get()[0]);
		$.ajax({
			type: 'post',
			url: 'ajax-for-saving.php',
			data: changeForm,
			contentType: false,
			processData: false,
			success: function(data) {
				$('#viewer').html(data);
      			$(this).remove();
	      	},
	      	error: function(data) {
	      		alert(data);
	      	}
		});	
	});
	$(document).on('click', '.dir_opened', function() {
		var subdir = $(this).next('.subdir');
		subdir.remove();
		$(this).removeClass("dir_opened");
		$(this).addClass("dir_closed");	
		$(this).children('img').attr('src', 'images/folder.png');
	});
	$(document).on('click', '#download', function() {
		var link=document.createElement('a');
		document.body.appendChild(link);
		link.href=$(this).attr('rel');
		link.setAttribute('download', '');
		link.click();
	});
	$(document).on('click', '.delete', function() {
		$.ajax({
				type: 'POST',
				url: "ajax-for-delete.php",
				data: 'name=' + $(this).attr('rel'),
				success: function(data) {
					$('#viewer').empty();
					$('.active_file').remove();

				}
	});
	});
	$(document).on('dblclick', '.fileName', function() {
		if(!$("#new_name").length) {
			name = $(this).text();
			$(this).empty();
			$html = "<input type='text' id='new_name' value=" + name + "></input>";
			$(this).html($html);
			$('.active_file').append("<div id='save_name'></div>");
		}		
	});
	$(document).on('keyup', '#new_name', function(event){
	    if(event.keyCode == 13){
	        event.preventDefault();
	        $('#save_name').click();
	    }
	});
	$(document).on('click', '#save_name', function() {
		oldName = $('.active_file').attr('rel');
		newN = $('.active_file').children('.fileName').children('#new_name').val();
		newName = oldName.substring(0, oldName.lastIndexOf("/") + 1) + newN;
		$.ajax({
			type: "post",
			url: "ajax-for-rename.php",
			data: {
				newName: newName,
				oldName: oldName
			},
			success: function(data) {
				$('#viewer').empty();
				$('#save_name').remove();
				$('.active_file').attr('rel', newName);
				$('.active_file').children('.fileName').empty();
				$('.active_file').children('.fileName').append(newN);
				$('.active_file').click();
			}
		});
	});
}); 

</script>
<div id='content'>
<div id='catalog'>
<div class='dir_opened' id='root' rel="<?php echo $_SESSION['users_dir']; ?>">
	<img src='images/open-folder.png' class='folder'><?php echo $_SESSION['logged_user'] ?></div>
<div class='subdir'> 
<?php
 showdir($_SESSION['users_dir']);
?>
</div>
<div id='loadform'>
<form enctype="multipart/form-data" id='upload_file' method='post'>
    <input id="userfile" type="file" name="userfile"/>
    <input id="submit_button" type="submit" value="Отправить" />
</form></div></div>
<div id='conf' hidden='true'>
	<aside class="modal" id="delete_confirm">
	    <header>
	        <h2>Удаление элемента</h2>
	    </header>
	    <section>Вы уверены, что хотите удалить этот элемент?</section>
	    <footer class="footer">
	        <a href="" class="confirm_cancel btn">Нет</a> 
	        <a href="" class="confirm_ok btn">Да</a>
	    </footer>
	</aside>

</div>
<div id='viewer'>
</div>

</div>