jQuery.fn.autotree = function(options) {
	
	var options = jQuery.extend({
		tree_view: true,
		add_new: true,
		add_new_dlg: function(){},
		default_text: "Введите название"
	},options);

	return this.each(function(){
	
		var name = jQuery(this).attr('id') ? jQuery(this).attr('id') : 'autotree';
		var value = jQuery(this).attr('value') ? jQuery(this).attr('value') : '';
		var id = jQuery(this).attr('nid') ? jQuery(this).attr('nid') : '';
		
		jQuery(this).html(
			'<input type="hidden" name="'+name+'_id" value="'+id+'" />'+
			'<input class="long-item" type="text" name="'+name+'" value="'+value+'" placeholder="'+options.default_text+'" />'
		);
	
		if (options.add_new) {
			jQuery(this).append('<span id="add" class="small-button ui-button ui-corner-all ui-icon ui-icon-plusthick" unselectable="on">Добавить</span>');
			jQuery(this).find("span#add").bind('click',options.add_new_dlg);
		}
		
		if (options.tree_view) {
			jQuery(this).append('<span id="tree" class="small-button ui-button ui-corner-all ui-icon ui-icon-folder-collapsed" unselectable="on">Выбрать</span>');
			jQuery(this).find("span#tree").bind('click',function(){
				jQuery(this).append('<div id="dlg"><div id="tree"></div></div>');
				jQuery(this).find("div#dlg").dialog({
					title: 'Список',
					autoOpen: false,
					modal: true,
					resizable: false,
					position: ['center',100],
					width: 500
				});
				
			});
		}
		var objName = jQuery(this).find("input[name="+name+"]");
		var objID = jQuery(this).find("input[name="+name+"_id]");
		
		objName.autocomplete({
			source: '/main/actions/autotree.php?list='+options.table,
            minLength: 2,
            select: function( event, ui ) { 
				objID.val(ui.item.id); 
			}          
		});
		objName.keyup(function(){ 
			if (objName.val().length == 0) objID.val(0); 
		});
	
	});
	
};
