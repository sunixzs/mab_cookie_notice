<?php
if (! defined ( 'TYPO3_MODE' )) {
	die ( 'Access denied.' );
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin ( 'MAB.' . $_EXTKEY, 'Pi1', array (
		'CookieNotice' => 'main,googleAnalytics' 
), array (
		'CookieNotice' => 'main,googleAnalytics' 
) );

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin ( 'MAB.' . $_EXTKEY, 'Pi2', array (
		'CookieNotice' => 'googleAnalyticsOptOut'
), array (
		'CookieNotice' => 'googleAnalyticsOptOut'
) );

// Dispatching requests for ajax actions which requests a controlleraction
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['ajaxMabCookieNoticeControllerAction'] = 'EXT:' . $_EXTKEY . '/Resources/Private/Eid/ControllerActionDispatcher.php';