<script type="text/javascript">

$(function()
{
	$('.file_bulk_import_list_zip_info a').click(function()
	{
		clickedElement = $(this);
		zip_guid = clickedElement.attr('rel');
		filesElement = clickedElement.parent().parent().find('#files_'+zip_guid);
		
		filesElement.toggle();

		if(clickedElement.attr('loaded') == 'false')
		{
			$.getJSON('<?php echo FILE_BULK_IMPORT_BASEURL;?>proc/files/list', {guid: zip_guid}, function(response)
			{
				clickedElement.attr('loaded', 'true');
				filesElement.css('height', 'auto');
				filesElement.css('background', 'none');
				
				if(response.count>0)
				{
					filesElement.html(response.content);
				}
				else
				{
					filesElement.html('No files found.');
				}
			});
		}
	});

	$('.file_bulk_import_zip_list_files_delete').live('click', function()
	{
		if(confirm('<?php echo elgg_echo('file_bulk_import:confirmtext');?>'))
		{
			clickedElement = $(this);
			file_guid = clickedElement.attr('rel');
	
			clickedElement.parent().hide();
			$.getJSON('<?php echo FILE_BULK_IMPORT_BASEURL;?>proc/files/delete', {guid: file_guid}, function(response)
			{
				if(response.valid)
				{
					clickedElement.parent().remove();
				}
				else
				{
					clickedElement.parent().show();
				}
			});
		}
	});

	$('#file_bulk_import_check_all_files').live('change', function()
	{
		checked = $(this);
		$.each(checked.parent().parent().find('input[name="file_guids[]"]'), function(i, value)
		{
			if(checked.is(':checked'))
			{
				$(value).attr('checked', true);
			}
			else
			{
				$(value).attr('checked', false);
			}
		});
	});

	$('#file_bulk_delete').live('submit', function(e)
	{
		form = $(this);
		
		$.post(form.attr('action'), form.serialize(), function(response)
		{
			if(response.valid)
			{
				form.find('input[name="file_guids[]"]:checked').parent('li').remove();
			}
		},'json');
		
		e.preventDefault();
	});
});



</script>