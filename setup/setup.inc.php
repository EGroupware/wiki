<?php
/**
 * EGroupware - Wiki
 *
 * @link http://www.egroupware.org
 * @author Ralf Becker <RalfBecker-AT-outdoor-training.de>
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package wiki
 * @subpackage setup
 */

$setup_info['wiki']['name']      = 'wiki';
$setup_info['wiki']['title']     = 'Wiki';
$setup_info['wiki']['version']   = '17.1.001';
$setup_info['wiki']['app_order'] = 11;
$setup_info['wiki']['enable']    = 1;

$setup_info['wiki']['author']    = 'Tavi Team';
$setup_info['wiki']['license']   = 'GPL';
$setup_info['wiki']['description'] =
	'Wiki is a modified and enhanced version of <a href="http://tavi.sf.net" target="_new">WikkiTikkiTavi</a> for use with EGroupware.';
$setup_info['wiki']['maintainer'] = 'Ralf Becker';
$setup_info['wiki']['maintainer_email'] = 'RalfBecker@outdoor-training.de';

$setup_info['wiki']['tables'][] = 'egw_wiki_links';
$setup_info['wiki']['tables'][] = 'egw_wiki_pages';
$setup_info['wiki']['tables'][] = 'egw_wiki_rate';
$setup_info['wiki']['tables'][] = 'egw_wiki_interwiki';
$setup_info['wiki']['tables'][] = 'egw_wiki_sisterwiki';
$setup_info['wiki']['tables'][] = 'egw_wiki_remote_pages';

/* The hooks this app includes, needed for hooks registration */
$setup_info['wiki']['hooks']['admin'] = 'wiki_hooks::admin';
$setup_info['wiki']['hooks']['sidebox_menu'] = 'wiki_hooks::sidebox_menu';
$setup_info['wiki']['hooks'][] = 'config_validate';
$setup_info['wiki']['hooks']['settings'] = 'wiki_hooks::settings';
$setup_info['wiki']['hooks']['search_link'] = 'wiki_hooks::search_link';

// uncomment to automatic deinstall wiki, if it only contains the 3 default pages
//$setup_info['wiki']['autodeinstall'] = "SELECT COUNT(*)<=3 FROM egw_wiki_pages";

// Setup
$setup_info['wiki']['check_install'] = array(
	'pear.horde.org/Horde_Text_Diff'	=> array(
		'func'	=> 'pear_check',
		'from'	=> 'Wiki (diff in notifications)'
	)
);

/* Dependencies for this app to work */
$setup_info['wiki']['depends'][] = array
(
	'appname'  => 'api',
	'versions' => Array('17.1')
);

