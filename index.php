<?php
/**
 * EGroupware Wiki - UserInterface
 *
 * @link http://www.egroupware.org
 * @package wiki
 * @author Ralf Becker <RalfBecker-AT-outdoor-training.de>
 * @copyright (C) 2004-17 by RalfBecker-AT-outdoor-training.de
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @version $Id$
 */

use EGroupware\Api;

/* $Id$ */
if (isset($_GET['action']))	// calling the old code
{
	include('lib/main.php');
	exit;
}
else
{
	/**
	 * Check if we allow anon access and with which creditials
	 *
	 * @param array &$anon_account anon account_info with keys 'login', 'passwd' and optional 'passwd_type'
	 * @return boolean true if we allow anon access, false otherwise
	 */
	function wiki_check_anon_access(&$anon_account)
	{
		$config = Api\Config::read('wiki');

		if ($config['allow_anonymous'] && $config['anonymous_username'])
		{
			$anon_account = array(
				'login'  => $config['anonymous_username'],
				'passwd' => $config['anonymous_password'],
				'passwd_type' => 'text',
			);
			return true;
		}
		return false;
	}
}
// uncomment the next line if wiki should use a eGW domain different from the first one defined in your header.inc.php
// and of cause change the name accordingly ;-)
// $GLOBALS['egw_info']['user']['domain'] = $GLOBALS['egw_info']['server']['default_domain'] = 'developers';

$GLOBALS['egw_info']['flags'] = array(
	'disable_Template_class' => True,
	'noheader'  => True,
	'currentapp' => 'wiki',
	'autocreate_session_callback' => 'wiki_check_anon_access',
);
include('../header.inc.php');
$goto = 'wiki.wiki_ui.view';
if (!empty($_REQUEST['menuaction']))
{
	$buff = explode('.',$_REQUEST['menuaction']);
	// the app-prefix check alone is NOT a security boundary (any menuaction with app-part "wiki"
	// passes it, regardless of which class/method it names) - restrict dispatch to wiki_ui's own
	// public entry points, mirroring its $public_functions allowlist
	if ($buff[0] === 'wiki' && $buff[1] === 'wiki_ui' &&
		in_array($buff[2] ?? '', ['edit', 'view', 'search'], true))
	{
		  $goto = implode('.',$buff);
	}
}
ExecMethod($goto);

// Expire old versions, etc.
if (!is_object($GLOBALS['wiki_ui']))
{
	ExecMethod('wiki.wiki_ui.maintain');
}
else
{
	$GLOBALS['wiki_ui']->maintain();
}
echo $GLOBALS['egw']->framework->footer();
