<?php
/**
 * EGroupware Wiki - SiteMgr module
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

/**
 * extends the wiki user-interface for sitemgr
 *
 * As php cant do multiple inheritance, we have to use two classes
 */
class sitemgr_wiki extends wiki_ui
{
	var $wikipage_param = 'wikipage';	// name of the get-param used to transport the wiki-page-names
	var $wikilang_param = 'wikilang';	// name of the get-param used to transport the wiki-lang
	var $search_tag = '--s-e-a-r-c-h--';	// used to mark queries
	var $arguments;

	function __construct($arguments)
	{
		$this->arguments = $arguments;

		// calling the constructor of the extended class
		parent::__construct();
	}

	/**
	 * reimplemented that the we stay in SiteMgr and dont loose the actual SiteMgr page
	 */
	function viewURL($page, $lang='', $version='', $full = '')
	{
		unset($version, $full);	// not used, but requires by function signature

		$url = $_SERVER['PHP_SELF'].'?';
		foreach($_GET as $name => $val)
		{
			if (!in_array($name,array('search',$this->wikipage_param,$this->wikilang_param)))
			{
				$url .= $name.'='.urlencode($val).'&';
			}
		}
		foreach(array('lang','version','full') as $name)
		{
			if ($$name || is_array($page) && $page[$name])
			{
				if (!$$name && !($$name = $page[$name])) continue;

				if ($name != 'lang')
				{
					$url .= $name.'='.urlencode($$name).'&';
				}
				elseif($lang != $GLOBALS['egw_info']['user']['prefereces']['common']['lang'])
				{
					$url .= $this->wikilang_param.'='.urlencode($$name).'&';
				}
			}
		}
		$url .= $this->wikipage_param.'='.urlencode(is_array($page) ? $page['name'] : $page);

		// the page-parameter has to be the last one, as the old wiki code only calls it once with empty page and appends the pages later
		return $url;
	}

	/**
	 * reimplemented to disallow editing
	 */
	function editURL($page, $lang='',$version = '')
	{
		unset($page, $lang, $version);	// not used, but required by function signature

		return False;
	}

	/**
	 * Show the page-header for the sitemgr module
	 *
	 * @param object|boolean $page sowikipage object or false
	 * @param string $title title of the search
	 */
	function header($page=false,$title='')
	{
		if ($page && ($this->arguments['title'] == 2 || $this->arguments['title'] == 1 && $page->name == $this->arguments['startpage']))
		{
			if (isset($page->title)) $title = Api\Html::htmlspecialchars($page->title);
		}
		if ($this->arguments['search'])
		{
			$search = '<form class="wiki-search" action="'.htmlspecialchars($this->viewURL($this->search_tag)).'" method="POST">'.
				'<input name="search" value="'.Api\Html::htmlspecialchars($_REQUEST['search']).'" />&nbsp;'.
				'<input type="submit" value="'.Api\Html::htmlspecialchars(lang('Search')).'" /></form>'."\n";
		}
		if ($title && $search || $search && $this->arguments['title'] == 1)
		{
			return '<table class="wiki-title" cellpadding="0" cellspacing="0"><tr><td><div class="wiki-title">'.$title.
				'</div></td><td align="right" class="wiki-search">'.$search."</td></tr></table>\n";
		}
		elseif ($title)
		{
			return '<div class="wiki-title">'.$title."</div>\n";
		}
		else
		{
			return '<div class="wiki-search">'.$search."</div>\n";
		}
		return '';
	}

	/**
	 * Show the page-footer for the sitemgr module
	 *
	 * @param object|boolean $page sowikipage object or false
	 */
	function footer($page=false)
	{
		unset($page);	// not used, but required by function signature

		return '';
	}

	/**
	 * view a manual page
	 */
	function view()
	{
		$wikipage = isset($_GET[$this->wikipage_param]) ? stripslashes(urldecode($_GET['wikipage'])) :
			(empty($this->arguments['startpage']) ? $this->config['wikihome'] : $this->arguments['startpage']);

		if ($wikipage == $this->search_tag) return $this->search(true);

		$parts = explode(':',$wikipage);
		if (count($parts) > 1)
		{
			$lang = array_pop($parts);
			if (strlen($lang) == 2 || strlen($lang) == 5 && $lang[2] == '-')
			{
				$wikipage = implode(':',$parts);
			}
			else
			{
				$lang = $_GET[$this->wikilang_param];
			}
		}
		$page =& $this->page($wikipage,$lang);
		if ($page->read() === False) $page = false;

		$html = $this->header($page);

		if (!$page) $html .= '<p><b>'.lang("Page '%1' not found !!!",'<i>'.$wikipage.($lang ? ':'.$lang : '').'</i>')."</b></p>\n";

		$html .= '<div class="wiki-content">' . $this->get($page) . "</div>\n";
		$html .= $this->footer($page);

		return $html;
	}
}

/**
 * extends SiteMgr's Module class and instanciates the sitemgr_wiki class to display pages
 */
class module_wiki extends Module
{
	function __construct()
	{
		Api\Translation::add_app('wiki');

		$this->arguments = array(
			'startpage' => array(
				'type' => 'textfield',
				'label' => lang('Wiki startpage')
			),
			'title' => array(
				'type' => 'select',
				'label' => lang('Show the title of the wiki page'),
				'options' => array(
					0 => lang('never'),
					1 => lang('only on the first page'),
					2 => lang('on all pages'),
				)
			),
			'search' => array(
				'type' => 'checkbox',
				'label' => lang('Show a search'),
			),
		);
		$this->properties = array();
		$this->title = lang('Wiki');
		$this->description = lang('Use this module for displaying wiki-pages');
	}

	function get_content(&$arguments,$properties)
	{
		unset($properties);	// not used, but required by function signature

		if (!@$GLOBALS['egw_info']['user']['apps']['wiki'])
		{
			return lang('You have no rights to view wiki content !!!');
		}
		$wiki = new sitemgr_wiki($arguments);

		return $wiki->view();
	}
}
