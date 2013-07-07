var dlg_TEMPLATE = '#dlg-TEMPLATE';
var dlg_TEMPLATE_ajax = './dialogs/TEMPLATE/dlg_TEMPLATE.php';

function OpenTEMPLATEDlg(){
	$(dlg_TEMPLATE).attr('title','TEMPLATE_TITLE');
	$(dlg_TEMPLATE).dialog({
		autoOpen: false,
		width: 500,
        modal: true,
        resizable: false,
		buttons: {
			"Отмена": function() {
				$(this).dialog("close");
			},
			"Сохранить": function() {
				$.ajax ({
						// SAVE CODE HERE
					}
				});
				$(this).dialog("close");
			}
		}
	});
    $.post (
		// LOAD CODE HERE       
	);
	$(dlg_TEMPLATE).dialog('open');
}

