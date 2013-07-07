jQuery.fn.contragent = function(options) {
	
	var options = jQuery.extend({
		add_new: true
	},options);

	return this.each(function(){
	
		var name = jQuery(this).attr('id') ? jQuery(this).attr('id') : 'cagent';
		var value = jQuery(this).attr('value') ? jQuery(this).attr('value') : '';
		var id = jQuery(this).attr('nid') ? jQuery(this).attr('nid') : '';
		
		jQuery(this).html(
			'<input type="hidden" name="'+name+'_id" value="'+id+'" />'+
			'<input class="long-item" type="text" name="'+name+'" value="'+value+'" placeholder="Введите название организации" />');
	
		if (options.add_new) {
			jQuery(this).append('<span class="small-button ui-button ui-corner-all ui-icon ui-icon-plusthick" unselectable="on">Добавить</span>');
			jQuery(this).find("span").bind('click',ShowAgentsDlg);
		}
		
		var objName = jQuery(this).find("input[name="+name+"]");
		var objID = jQuery(this).find("input[name="+name+"_id]");
		
		objName.autocomplete({
			source: '/main/dialogs/agents/search_agent_alone.php',
            minLength: 2,
            select: function( event, ui ) { objID.val(ui.item.id); }          
		});
		objName.keyup(function(){ 
			if (objName.val().length == 0) objID.val(0); 
		});
	
	});
	
};
