<?php

	require($_SERVER['DOCUMENT_ROOT'].'/module/sumtotxt/sumtotxt.php');
	//$data = VSECore::UTF2Win1251($_POST);
	$data = $_POST;
	$data['name'] = VSECore::UTF2Win1251($_POST['name']);
	$i = 0; $sum = 0.00;
	foreach($data['id'] as $id){
		//$rows[$i]['name'] = array('name'=>$data['name']);
		//$rows[$i]['name'] = $VSECore->Win12512UTF8($data['name'][$i]);
		$rows[$i]['name'] = $data['name'][$i];
		$rows[$i]['count'] = $data['count'][$i];
		$rows[$i]['price'] = $data['price'][$i];
		$rows[$i]['sum'] = $data['count'][$i]*$data['price'][$i];
		$sum += $rows[$i]['sum'];
		$rows[$i]['sum'] = sprintf('%.2f',$rows[$i]['sum']);
		$rows[$i]['num'] = $i+1;
		$i++;
	}
	$VSECore->output->assign('rows',$rows);
	$VSECore->output->assign('date',date("d.m.Y"));
	$VSECore->output->assign('total_sum',CurrencyToText($sum));
	$VSECore->output->assign('user',$VSECore->user->showname());
	$VSECore->output->fetch($_SERVER['DOCUMENT_ROOT'].'/main/pforms/cash-memo/cash-memo.tpl');    
	$VSECore->output->body();

?>