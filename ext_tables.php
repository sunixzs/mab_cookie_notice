<?php
if (! defined ( 'TYPO3_MODE' )) {
	die ( 'Access denied.' );
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin ( 'MAB.' . $_EXTKEY, 'Pi2', 'Cookie Notice: Google Analytics-OptOut-Link' );

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile ( $_EXTKEY, 'Configuration/TypoScript', 'Cookie Notice' );