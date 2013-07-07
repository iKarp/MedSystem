jQuery.org = function(options) {

	var container = options.container;
	var agreement = options.agreement;

    var agreement_date = container+ " input[name=agreement_date]";
    var organization_id = container + " input[name=organization_id]";
    var name = container + " input[name=name]";
    /*var oms_organization_id = container + " select[name=oms_organization_id]";*/


	$(agreement_date).datepicker({changeMonth: true, changeYear: true,dateFormat : 'yy-mm-dd'});

    $(agreement).autocomplete({
			source: '/module/address/ajax.php?action=search_org'
			,minLength: 5
            ,delay: 1000
			,select: function(event, ui) {
			    $(organization_id).val(ui.item.id)
                $(name).val(ui.item.name);
                $(agreement_date).val(ui.item.agreement_date);
                /*$(oms_organization_id).val(ui.item.oms_organization_id);*/

                // enable all items
                //$(container +" input,select").attr('disabled','true');
				$(name).attr('disabled','true');
				$(agreement_date).attr('disabled','true');
				/*$(oms_organization_id).attr('disabled','true');*/

            }

    });

	$(agreement).keyup(function(){
        if ($(agreement).val() == "") {
			$(agreement_date+","+name+","+organization_id).val('');
			$(agreement_date+","+name+","+organization_id).attr('disabled','');
		}
	});

   if ($(organization_id).val() != "") {
        //$(container +" input,select").attr('disabled','true');
        $(name).attr('disabled','true');
        $(agreement_date).attr('disabled','true');
       /* $(oms_organization_id).attr('disabled','true');*/
   }

}
