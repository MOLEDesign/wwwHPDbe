<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.model' );
class EservicesModelEservices extends JModel
{

  function __construct()
  {

        parent::__construct();
  }
  /*
		Use the code below to retrieve an url from the eservices.txt by providing a type	
   
		JLoader::import('joomla.application.component.model'); 
		JLoader::import( 'Eservices', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_eservices' . DS . 'models' );
		$eservices_model = JModel::getInstance( 'Eservices', 'EservicesModel' );
		$showdocument_url = $eservices_model->getUrl("type");
   */
   
function cleanup($output){
	$output = str_replace(array("\r\n", "\r"), "\n", $output);
	$lines = explode("\n", $output);
	$new_lines = array();

	foreach ($lines as $i => $line) {
		if(!empty($line))
			$new_lines[] = trim($line);
	}
	return implode($new_lines);
}
  function getUrl($type)
  {
	//return "test";
	$myFile = JURI::root()."eservices.txt";
	//$myFile = JPATH_BASE."\eservices.txt";
	$fh = fopen($myFile, 'r');
	$i=1;
	while($url = fgets($fh))
	{
		$url_parts = explode("|",$url);
		$urls[$url_parts[0]]=$url_parts[1];
	}
	fclose($fh);
	
	foreach ($urls as $key => $value) {
		if ($type==$key)
		{
			return $this->cleanup($value);
		}
	}
  }
  

}
?>