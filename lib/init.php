<?php
	// $Id$

	// General initialization code.

	require('lib/defaults.php');
	//require('config.php');		// this has gone into the admin-page

	$sessionid = (isset($_GET['sessionid'])?$_GET['sessionid']:(isset($_COOKIE['sessionid'])?$_COOKIE['sessionid']:''));

	//if ($sessionid || !(AnonymousSession == 'readonly' || AnonymousSession == 'editable'))
	if ($sessionid)
	{
		$GLOBALS['phpgw_info']['flags']['noheader'] = True;

		include('../header.inc.php');

		$c = CreateObject('phpgwapi.config','wiki');
		$c->read_repository();
		$config = $c->config_data;

		if($config[allow_anonymous])
		{
			if($config[Anonymous_Session_Type])
			{	
				define('AnonymousSession',$config[Anonymous_Session_Type]); // editable gives full anonymous access (still no admin)
			}
			define('AnonymousUser',$config[anonymous_username]);
			define('AnonymousPasswd',$config[anonymous_password]);
		}

		$HomePage = (isset($config[wikihome])?$config[wikihome]:'eGroupWare');
		$InterWikiPrefix = (isset($config[InterWikiPrefix])?$config[InterWikiPrefix]:'EGroupWare');
		$EnableFreeLinks = (isset($config[Enable_Free_Links])?$config[Enable_Free_Links]:1);
		$EnableWikiLinks = (isset($config[Enable_Wiki_Links])?$config[Enable_Wiki_Links]:1);
		$EditWithPreview = (isset($config[Edit_With_Preview])?$config[Edit_With_Preview]:1);
	}
	else
	{
		$login  = AnonymousUser;
		$passwd = AnonymousPasswd;

		$GLOBALS['phpgw_info']['flags'] = array(
			'disable_Template_class' => True,
			'login' => True,
			'currentapp' => 'login',
			'noheader'  => True
		);
		include('../header.inc.php');

		$c = CreateObject('phpgwapi.config','wiki');
		$c->read_repository();
		$config = $c->config_data;

		if($config[allow_anonymous])
		{
			if($config[Anonymous_Session_Type])
			{	
				define('AnonymousSession',$config[Anonymous_Session_Type]); // editable gives full anonymous access (still no admin)
			}
			define('AnonymousUser',$config[anonymous_username]);
			define('AnonymousPasswd',$config[anonymous_password]);
		}

		$HomePage = (isset($config[wikihome])?$config[wikihome]:'eGroupWare');
		$InterWikiPrefix = (isset($config[InterWikiPrefix])?$config[InterWikiPrefix]:'EGroupWare');
		$EnableFreeLinks = (isset($config[Enable_Free_Links])?$config[Enable_Free_Links]:1);
		$EnableWikiLinks = (isset($config[Enable_Wiki_Links])?$config[Enable_Wiki_Links]:1);
		$EditWithPreview = (isset($config[Edit_With_Preview])?$config[Edit_With_Preview]:1);

		if (! $GLOBALS['phpgw']->session->verify())
		{
			$login  = AnonymousUser;
			$passwd = AnonymousPasswd;

			$sessionid = $GLOBALS['phpgw']->session->create($login,$passwd,'text');
		}
		if (!$sessionid) {
			echo "<p>Can't create session for user '".AnonymousUser."' !!!</p>\n";
		}
		else
		{	
			$GLOBALS['phpgw']->redirect($GLOBALS['phpgw']->link('/wiki/index.php',$_SERVER['QUERY_STRING']));
		}
		$GLOBALS['phpgw']->common->phpgw_exit();
	}

	define('TemplateDir', 'template');

	$Charset = $GLOBALS['phpgw']->translation->charset();
	if (strtolower($Charset) == 'iso-8859-1')	// allow all iso-8859-1 extra-chars
	{
		$UpperPtn = "[A-Z\xc0-\xde]";
		$LowerPtn = "[a-z\xdf-\xff]";
		$AlphaPtn = "[A-Za-z\xc0-\xff]";
		$LinkPtn = $UpperPtn . $AlphaPtn . '*' . $LowerPtn . '+' .
			$UpperPtn . $AlphaPtn . '*(\\/' . $UpperPtn . $AlphaPtn . '*)?';
	}

	$UserName = $GLOBALS['phpgw_info']['user']['account_lid'];
	$anonymous = $UserName == AnonymousUser;
	// echo "<p>user='$UserName', AnonymousUser='".AnonymousUser."', anonymous=".($anonymous?'True':'False').", action='$action', Preview='$Preview'</p>\n";
	if (!($action == 'save' && !$Preview) && $action != 'admin' && !($action == 'prefs' && $Save))
	{
		$GLOBALS['phpgw_info']['flags']['nonavbar'] = $anonymous;
		$GLOBALS['phpgw']->common->phpgw_header();
	}

	$WikiLogo = $GLOBALS['phpgw_info']['server']['webserver_url'] . '/phpgwapi/templates/default/images/logo.png';

	require('lib/url.php');
	require('lib/messages.php');

	$pagestore = CreateObject('wiki.sowiki');

	$FlgChr = chr(255);                     // Flag character for parse engine.

	$Entity = array();                      // Global parser entity list.

	// Strip slashes from incoming variables.

	if(get_magic_quotes_gpc())
	{
		$document = stripslashes($document);
		$categories = stripslashes($categories);
		$comment = stripslashes($comment);
		if (is_array($page))
		{
			$page['name'] = stripslashes($page['name']);
		}
		else
		{
			$page = stripslashes($page);
		}
	}

	// Read user preferences from cookie.

	$prefstr = isset($_COOKIE[$CookieName])
	? $_COOKIE[$CookieName] : '';

	if(!empty($prefstr))
	{
		if(ereg("rows=([[:digit:]]+)", $prefstr, $result))
		{ $EditRows = $result[1]; }
		if(ereg("cols=([[:digit:]]+)", $prefstr, $result))
		{ $EditCols = $result[1]; }
		if(ereg("user=([^&]*)", $prefstr, $result))
		{ $UserName = urldecode($result[1]); }
		if(ereg("days=([[:digit:]]+)", $prefstr, $result))
		{ $DayLimit = $result[1]; }
		if(ereg("auth=([[:digit:]]+)", $prefstr, $result))
		{ $AuthorDiff = $result[1]; }
		if(ereg("min=([[:digit:]]+)", $prefstr, $result))
		{ $MinEntries = $result[1]; }
		if(ereg("hist=([[:digit:]]+)", $prefstr, $result))
		{ $HistMax = $result[1]; }
		if(ereg("tzoff=([[:digit:]]+)", $prefstr, $result))
		{ $TimeZoneOff = $result[1]; }
	}

	#if($Charset != '')
	#  { header("Content-Type: text/html; charset=$Charset"); }

	?>
