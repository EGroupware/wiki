<?php
// eTemplates for Application 'wiki', generated by soetemplate::dump4setup() 2005-10-13 17:07

/* $Id$ */

$templ_version=1;

$templ_data[] = array('name' => 'wiki.edit','template' => '','lang' => '','group' => '0','version' => '1.0.0','data' => 'a:1:{i:0;a:5:{s:4:"type";s:4:"grid";s:4:"data";a:9:{i:0;a:7:{s:2:"h3";s:10:",!@is_html";s:2:"h4";s:9:",@is_html";s:2:"c1";s:2:"th";s:2:"c2";s:3:"row";s:2:"c3";s:3:"row";s:2:"c5";s:3:"row";s:2:"c6";s:3:"row";}i:1;a:2:{s:1:"A";a:2:{s:4:"type";s:5:"label";s:5:"label";s:4:"Name";}s:1:"B";a:6:{s:4:"type";s:4:"hbox";s:4:"size";s:5:"4,0,0";i:1;a:3:{s:4:"type";s:4:"text";s:4:"size";s:2:"60";s:4:"name";s:4:"name";}i:2;a:5:{s:4:"type";s:6:"select";s:4:"span";s:13:",leftpadding5";s:5:"label";s:4:"Lang";s:7:"no_lang";s:1:"1";s:4:"name";s:4:"lang";}i:3;a:5:{s:4:"type";s:6:"button";s:4:"span";s:13:",leftpadding5";s:5:"label";s:4:"Load";s:4:"name";s:12:"action[load]";s:4:"help";s:74:"Loads the named page in the given language, all change so far get lost !!!";}i:4;a:5:{s:4:"type";s:6:"button";s:4:"span";s:13:",leftpadding5";s:5:"label";s:6:"Rename";s:4:"name";s:14:"action[rename]";s:4:"help";s:43:"Renames page to the given name and language";}}}i:2;a:2:{s:1:"A";a:2:{s:4:"type";s:5:"label";s:5:"label";s:5:"Title";}s:1:"B";a:7:{s:4:"type";s:4:"hbox";s:4:"size";s:5:"5,0,0";i:1;a:4:{s:4:"type";s:4:"text";s:4:"size";s:2:"60";s:4:"name";s:5:"title";s:4:"help";s:45:"different languages can have different titles";}i:2;a:3:{s:4:"type";s:5:"label";s:4:"span";s:13:",leftpadding5";s:5:"label";s:11:"Writable by";}i:3;a:6:{s:4:"type";s:14:"select-account";s:4:"size";s:7:",groups";s:4:"span";s:13:",leftpadding5";s:7:"no_lang";s:1:"1";s:4:"name";s:8:"writable";s:4:"help";s:36:"who should be able to edit this page";}i:4;a:3:{s:4:"type";s:5:"label";s:4:"span";s:13:",leftpadding5";s:5:"label";s:11:"Readable by";}i:5;a:6:{s:4:"type";s:14:"select-account";s:4:"size";s:7:",groups";s:4:"span";s:13:",leftpadding5";s:7:"no_lang";s:1:"1";s:4:"name";s:8:"readable";s:4:"help";s:36:"who should be able to read this page";}}}i:3;a:2:{s:1:"A";a:4:{s:4:"type";s:8:"htmlarea";s:4:"span";s:3:"all";s:4:"name";s:4:"text";s:4:"size";s:28:",TableOperations,ContextMenu";}s:1:"B";a:3:{s:4:"type";s:8:"htmlarea";s:4:"name";s:7:"preview";s:8:"readonly";s:1:"1";}}i:4;a:2:{s:1:"A";a:4:{s:4:"type";s:8:"textarea";s:4:"size";s:6:"15,120";s:4:"span";s:3:"all";s:4:"name";s:4:"text";}s:1:"B";a:1:{s:4:"type";s:5:"label";}}i:5;a:2:{s:1:"A";a:2:{s:4:"type";s:5:"label";s:5:"label";s:7:"Summary";}s:1:"B";a:4:{s:4:"type";s:4:"text";s:4:"size";s:2:"80";s:4:"name";s:7:"summary";s:4:"help";s:17:"Summary of change";}}i:6;a:2:{s:1:"A";a:2:{s:4:"type";s:5:"label";s:5:"label";s:8:"Category";}s:1:"B";a:4:{s:4:"type";s:4:"text";s:4:"size";s:2:"80";s:4:"name";s:8:"category";s:4:"help";s:24:"Add document to category";}}i:7;a:2:{s:1:"A";a:9:{s:4:"type";s:4:"hbox";s:4:"size";s:1:"6";s:4:"span";s:1:"2";i:1;a:4:{s:4:"type";s:6:"button";s:5:"label";s:4:"Save";s:4:"name";s:12:"action[save]";s:4:"help";s:25:"Save the changes and exit";}i:2;a:4:{s:4:"type";s:6:"button";s:5:"label";s:5:"Apply";s:4:"name";s:13:"action[apply]";s:4:"help";s:27:"Saves and continues editing";}i:3;a:4:{s:4:"type";s:6:"button";s:5:"label";s:7:"Preview";s:4:"name";s:15:"action[preview]";s:4:"help";s:19:"Updates the preview";}i:4;a:4:{s:4:"type";s:6:"button";s:5:"label";s:6:"Delete";s:4:"name";s:14:"action[delete]";s:4:"help";s:17:"Deletes this page";}i:5;a:4:{s:4:"type";s:6:"button";s:5:"label";s:8:"Richtext";s:4:"name";s:15:"action[convert]";s:4:"help";s:29:"Converts the page to richtext";}i:6;a:4:{s:4:"type";s:6:"button";s:5:"label";s:6:"Cancel";s:4:"name";s:14:"action[cancel]";s:4:"help";s:21:"Cancel without saving";}}s:1:"B";a:1:{s:4:"type";s:5:"label";}}i:8;a:2:{s:1:"A";a:4:{s:4:"type";s:8:"htmlarea";s:4:"span";s:1:"2";s:4:"name";s:7:"preview";s:8:"readonly";s:1:"1";}s:1:"B";a:1:{s:4:"type";s:5:"label";}}}s:4:"rows";i:8;s:4:"cols";i:2;s:4:"size";s:4:"100%";}}','size' => '100%','style' => '.leftpadding5 { padding-left: 5px; }
','modified' => '1081770713',);

