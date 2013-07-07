var ajax_controller = '/main/ajax.php';
var debug = true;

$(document).ready(function(){
	
    $('.left-menu-button').button();			// Кнопки левого меню
	
	$(".tabs td").live('click',function(){		// Все вкладки
		$(this).parent().children().css('background-color','#F2F5F7');
		$(this).css('background-color','#3BAAE3');
		return false;   
	});
	
	$('#alert-msg').dialog({					// Всплывающие сообщения
		autoOpen: false,
		dialogClass: 'alert',
		draggable: false,
		modal: true,
		resizable: false,
		width: 135,
		height: 30
	}).prev().remove();
	
	$('#btn-test').click(function(){
		Print('techcard',{product_id: 136, per_id: 2360, debug: true});
		return false;
	});
	
});

function OpenDialog(param) {
    Call('get_dialog',{dlg: param.dlg},
		function(dlg){    
			$(dlg.dom).dialog({
            	title: dlg.title,
        		autoOpen: false,
        		modal: true,
                resizable: false,
        		width: parseInt(dlg.width),
        		buttons: {
        			"Закрыть": 	function() { $(dlg.dom).dialog("close"); },
        			'Сохранить':function() { $(dlg.dom).dialog("close"); Call(dlg.save,$(dlg.dom+' form').serialize(),param.callback); },
					'Удалить': 	function() { if (confirm('Удалить запись?')){ $(dlg.dom).dialog("close"); Call(dlg.del,$(dlg.dom+' form').serialize(),param.callback);} }
        		}
			});
        
			Call(dlg.open,{id: param.id},function(html){
				$(dlg.dom).html(html); 
				if (param.init) param.init(dlg.dom);
				$(dlg.dom).dialog('open');
			});
        }
	);
}

// ShowTable - формирует таблицу
// Параметры:
//		table - название таблицы (должно быть в core_tables)
//		filter - фильтр вывода
//		dom - идентификатор объекта в котором прорисуется таблица
//		onselect: - выбор строки таблицы
//			dlg - диалог вызываемый при выборе строки
//			init - 
//			callback - имя функции вызываемой после закрытия диалога
//		callback - имя функции вызываемой после отображения таблицы

function ShowTable(param) {
	Call('show_table',{table: param.table, filter: param.filter},
		function(html){
			//Log('onselect.func = '+param.onselect.func);
			//Log('onselect.init = '+param.onselect.init);
			//Log('onselect.callback = '+param.onselect.callback);
			$(param.dom).html(html);
			$(param.dom+' tr.newrow').bind("click",function(){
				param.onselect.func({id: '', dlg: param.onselect.dlg, init: param.onselect.init, callback: param.onselect.callback})
			});
			$(param.dom+' tr.datarow').bind("click",function(){
				param.onselect.func({id: $(this).attr("data_id"), dlg: param.onselect.dlg, init: param.onselect.init, callback: param.onselect.callback})
			});
			if (param.callback) param.callback();
		}
	);
}

function Call(action,param,callback) {	
	$.post(
		ajax_controller+'?gettype',
		{action: action},
		function(act){
			if (!act) return "No answer from AJAX-controller";
			if (act.error) {
				alert('Ошибка при получении параметров действия');
				Log('Error: '+act.error);
				Log('Action: '+action);
				Log('Params: '+param);
				Log('CallBack: '+callback);
			}
			else {
				if (act.type == 'load') AlertLoading('open');
				if (act.type == 'save') AlertSaving(1500);
				$.post(
					ajax_controller+'?action='+action,
					param,
					function(result){
						if (result) {
							if (result.error) alert(result.error); else callback(result);
						}
						else alert('Нет ответа от AJAX-контроллера');
						if (act.type == 'load') AlertLoading('close');
					},
					act.result_type
				);		
			}
		},'json'
	);	
	return false;
}

function Print(pform,param){
	$.post(
		ajax_controller+'?action=print_'+pform,
		param,
		function(result){
			if (result) {
				var w = window.open('','_blank','width=800,toolbar=0,menubar=0,location=0,scrollbars=yes');
				w.document.open();  // Открываем документ для записи
				w.document.writeln('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">');
				w.document.writeln('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">');
				w.document.writeln('<head>');
				w.document.writeln('<meta http-equiv="content-type" content="text/html; charset=Windows-1251" />');
				w.document.writeln('<title>Печатная форма</title>');
				w.document.writeln('<link rel="stylesheet" href="/static/css/print.css" type="text/css">');
				w.document.writeln('</head>');
				if (param.debug) w.document.writeln('<body>'); else w.document.writeln('<body onload="javascript:window.print();">');
				w.document.writeln(result);
				w.document.writeln('</body>');
				w.document.writeln('</html>');
				w.document.close(); 				
			}
			else alert('Нет ответа от AJAX-контроллера');
		},
		'html'
	);
	return false;
}

function Log(obj) {
    if (window.console) {
        if (true) console.log(obj);
    }
};

function AlertSaving(time) {
	$('#alert-msg span').html('СОХРАНЕНИЕ');
	$('#alert-msg').dialog('open');
	setTimeout("$('#alert-msg').dialog('close')",time);	
};

function AlertLoading(action) {
	if (action == 'open'){
		$('#alert-msg span').html('ЗАГРУЗКА');
		$('#alert-msg').dialog('open');
	}
	else if (action == 'close')
		setTimeout("$('#alert-msg').dialog('close')",200);	
};

function toMoney(val){
	var ful = parseInt(val*100);
	var ost = parseFloat(val*100 - ful);
	if (ost > 0.0) ful += 1;
	return parseFloat(ful/100);
}