<?

$class_array = array("VSEObjectList","VSEAddressList","VSEInteractiveList","VSEOMSOrganizationList","VSEOrganizationList","VSEPersonList","VSEStreetList","VSEUserList","VSEmkb10List");

foreach ($class_array as $class) {
	require_once (dirname(__FILE__)."/$class.class.php");
}

?>
