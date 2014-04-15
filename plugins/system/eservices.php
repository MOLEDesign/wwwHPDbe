<?php
/**
 * @version        $Id: redirect.php 390 2010-11-05 11:35:33Z eddieajau $
 * @package        NewLifeInIT
 * @subpackage    plgSystemGetservices
 * @copyright    Copyright 2005 - 2010 New Life in IT Pty Ltd. All rights reserved.
 * @license        GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link        http://www.theartofjoomla.com
 */

defined('JPATH_BASE') or die;

/**
 * Plugin class for Getservices.
 *
 * @package        NewLifeInIT
 * @subpackage    plgSystemGetservices
 * @since        1.0
 */
class plgSystemEservices extends JPlugin
{
    public function plgEservices(&$subject, $config)
    {
        parent::__construct($subject, $config);
    }
    function onAfterRender()
	{
		$app =& JFactory::getApplication();

		if($app->getName() != 'administrator') 
		{
			$myFile = JPATH_BASE."/eservices.txt";
			//$myFile = "D:\inetpub\wwwroot\hdp\eservices.txt";
			$fh = fopen($myFile, 'r');
			$i=1;
			while($url = fgets($fh))
			{
				$url_parts = explode("|",$url);
				$urls[$url_parts[0]]=$url_parts[1];
			}
			fclose($fh);
			
			$buffer = JResponse::getBody();
			
			$buffer = str_replace("http://www.e-services.hdp.be/ShowDocument?docId=",$urls['showdocument'], $buffer);
			
			$buffer = str_replace("https://www.e-services.hdp.be/reg/registration/lost_password_content.jsp",$urls['lostpassword'], $buffer);
			$buffer = str_replace("https://www.e-services.hdp.be/reg?lang",$urls['registerNoLang'], $buffer);

			$buffer = str_replace("https://www.e-services.hdp.be/registration/registration/lost_password_content.jsp",$urls['lostpassword'], $buffer);
			$buffer = str_replace("https://www.e-services.hdp.be/registration/registration/startRegistration.do?lang",$urls['registerNoLang'], $buffer);
			
			$buffer = str_replace("https://www.e-services.hdp.be/login.do",$urls['login'], $buffer);
			$buffer = str_replace("https://www.e-services.hdp.be/switchLanguage.do",$urls['switchlanguage'], $buffer);
			$buffer = str_replace("https://www.e-services.hdp.be/portal/JbossLoginServlet",$urls['login'], $buffer);
			
			JResponse::setBody($buffer);
		}
		return true;
	}
    
}