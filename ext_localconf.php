<?php
if (! defined ( 'TYPO3_MODE' )) {
	die ( 'Access denied.' );
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin ( 'MAB.' . $_EXTKEY, 'Pi1', array (
		'CookieNotice' => 'main,setMainCookie' 
), array (
		'CookieNotice' => 'main,setMainCookie' 
) );