<?php
/**
 * EGroupware Wiki
 *
 * @link http://www.egroupware.org
 * @package wiki
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 */

require(TemplateDir . '/prefs.php');

// View or set a user's preferences.
function action_prefs()
{
	global $Save, $referrer, $user, $rows, $cols, $days, $min, $auth, $hist;
	global $CookieName, $ErrorNameMatch, $tzoff;

	if(!empty($Save))
	{
		if(!empty($user))
		{
			if(!validate_page($user))
				{ die($ErrorNameMatch); }
		}

		if(!preg_match("/([[:digit:]]*)/", $rows, $result) || ($rows = $result[1]) <= 0)
			{ $rows = 20; }
		if(!preg_match("/([[:digit:]]*)/", $rows, $result) || ($cols = $result[1]) <= 0)
			{ $cols = 65; }
		if(strcmp($auth, "") != 0)
			{ $auth = 1; }
		else
			{ $auth = 0; }
		$value = "rows=$rows&amp;cols=$cols&amp;auth=$auth";
		if(strcmp($user, "") != 0)
			{ $value = $value . "&amp;user=" . urlencode($user); }
		if(strcmp($days, "") != 0)
			{ $value = $value . "&amp;days=$days"; }
		if(strcmp($min, "") != 0)
			{ $value = $value . "&amp;min=$min"; }
		if(strcmp($hist, "") != 0)
			{ $value = $value . "&amp;hist=$hist"; }
		if(strcmp($tzoff, "") != 0)
			{ $value = $value . "&amp;tzoff=$tzoff"; }
		setcookie($CookieName, $value, time() + 157680000, "/", "");
		header("Location: $referrer");
	}
	else
		{ template_prefs(); }
}
