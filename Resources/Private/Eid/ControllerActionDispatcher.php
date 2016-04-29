<?php
if (! defined ( 'TYPO3_MODE' ) || TYPO3_MODE !== 'FE') {
	die ( 'Could not access this script directly!' );
}
// Hand over to the Eid Utility Object
/** @var $dispatcher MAB\MabCookieNotice\Eid\ControllerActionDispatcher */
$dispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance ( 'MAB\\MabCookieNotice\\Eid\\ControllerActionDispatcher' );
echo $dispatcher->initAndDispatch ();
?>
