<?php
// $Id$

// Certain other settings may be configured; look in lib/defaults.php
// to see them.  Rather than changing them in lib/defaults.php, you
// should copy them from there to here.  The settings here will safely
// over-ride those in lib/defaults.php.

// $Admin specifies the administrator e-mail address used in error messages.
$Admin = 'webmaster@domain.com';

// $WikiName determines the name of your wiki.  This name is used in the
// browser title bar.  Often, it will be the same as $HomePage.
$WikiName = 'PhpGroupWare';

// $HomePage determines the "main" page of your wiki.  If browsers do not ask
// to see a specific page they will be shown the home page.  This should be
// a wiki page name, like 'AcmeProjectWiki'.
$HomePage = 'PhpGroupWare';

// $InterWikiPrefix determines what interwiki prefix you recommend other
// wikis use to link to your wiki. Usually it is similar to your WikiName.
$InterWikiPrefix = 'PhpGroupWare';

// If $EnableFreeLinks is set to 1, links of the form "((page name))" will be
// turned on for this wiki.  If it is set to 0, they will be disallowed.
$EnableFreeLinks = 1;

// If $EnableWikiLinks is set to 1, normal WikiNames will be treated as links
// in this wiki.  If it is set to 0, they will not be treated as links
// (in which case you should be careful to enable free links!).
$EnableWikiLinks = 1;

// $ScriptBase determines the location of your wiki script.  It should indicate
// the full URL of the main index.php script itself.
# simply set the relative directory here for phpgw support
$ScriptBase = $GLOBALS['phpgw']->link('/wiki/index.php');

// $AdminScript indicates the location of your admin wiki script.  It should
// indicate the full URL of the admin/index.php script itself.
$AdminScript = $GLOBALS['phpgw']->link('/wiki/admin/index.php');

// $WikiLogo determines the location of your wiki logo.
$WikiLogo = $GLOBALS['phpgw']->link('/wiki/templates/default/images/navbar.gif');

// $MetaKeywords indicates what keywords to report on the meta-keywords tag.
// This is useful to aid search engines in indexing your wiki.
$MetaKeywords = 'phpgw documentation wiki';

// $MetaDescription should be a sentence or two describing your wiki.  This
// is useful to aid search engines in indexing your wiki.
$MetaDescription = 'phpGroupWare Documentation Wiki';

// TemplateDir indicates what directory your wiki templates are located in.
// You may use this to install other templates than the default template.
define('TemplateDir', 'template');

// !!!WARNING!!!
// If $AdminEnabled is set to 1, the script admin/index.php will be accessible.
//   This allows administrators to lock pages and block IP addresses.  If you
//   want to use this feature, YOU SHOULD FIRST BLOCK ACCESS TO THE admin/
//   DIRECTORY BY OTHER MEANS, such as Apache's authorization directives.
//   If you do not do so, any visitor to your wiki will be able to lock pages
//   and block others from accessing the wiki.
// If $AdminEnabled is set to 0, administrator control will be disallowed.
$AdminEnabled = 1;

?>
