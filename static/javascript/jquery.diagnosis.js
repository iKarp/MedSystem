jQuery.diagnosis = function(options) {
	
	var diagnosis = options.diagnosis_input;
	var code = options.diagnosis_code_input;
	
	$(diagnosis).autocomplete({
	    source: '/module/diagnosis/ajax.php?action=search_diagnosis'
	    ,minLength: 3
	    ,delay: 500
	    ,select: function(event, ui) {
			$(code).val (ui.item.id);
			return false;
	    }
	});   
	
}
