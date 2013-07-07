jQuery.street = function(options) {
	
	var town = options.town_input;
	var street = options.street_input;
	var code = options.code_input;
	
	if (town) {
		
		$(town).autocomplete({
				source: '/module/address/ajax.php?action=search_town'
				,minLength: 3
                ,delay: 1000
				,select: function(event, ui) {
					$(code).val (ui.item.id);
					// reset params
					$ (street).val ('');
					// assign autosearch
					$(street).autocomplete({
						source: '/module/address/ajax.php?action=search_street&town_id=' + $(code).val ()
						,minLength: 3
                        ,delay: 1000
						,select: function(event, ui) {
							$(code).val (ui.item.id);
						}
					});
					
					//return false;
				}
		});
	}
	if ($(code).val() != "") {
	            $(street).autocomplete({
	                    source: '/module/address/ajax.php?action=search_street&town_id=' + $(code).val ()
	                    ,minLength: 3
	                    ,delay: 1000
	                    ,select: function(event, ui) {
		                            $(code).val (ui.item.id);
		                            //return false;
	                    }
 																		                });   
 																				        }
}
