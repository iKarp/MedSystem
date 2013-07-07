<?

$class_array = array("VSEDocsPerson","VSEDocsPassport","VSEDocsOMSPolis","VSEDocsDMSPolis","VSEOrganization","VSEOmsOrganization");

foreach ($class_array as $class) {
	require_once (dirname(__FILE__)."/$class.class.php");
}

/*require_once (dirname(__FILE__)."/VSEDocsPerson.class.php");
require_once (dirname(__FILE__)."/VSEDocsPassport.class.php");
require_once (dirname(__FILE__)."/VSEDocsOMSPolis.class.php");
require_once (dirname(__FILE__)."/VSEOrganization.class.php");*/


?>
