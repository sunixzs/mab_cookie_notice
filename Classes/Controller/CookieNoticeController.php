<?php

namespace MAB\MabCookieNotice\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Marcel Briefs <t3@lbrmedia.net>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * CookieNoticeController
 */
class CookieNoticeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	
	/**
	 * action main
	 * Shows the cookie notice
	 *
	 * @return void
	 */
	public function mainAction() {
		// if cookie is allready set show nothing
		if ($GLOBALS[ "TSFE" ]->fe_user->getKey ( "ses", "MabCookieNoticePi1" )) {
			return "";
		}
		
		// add Stylesheet files
		if (isset ( $this->settings[ 'includes' ][ 'StyleSheets' ] ) && is_array ( $this->settings[ 'includes' ][ 'StyleSheets' ] )) {
			foreach ( $this->settings[ 'includes' ][ 'StyleSheets' ] as $path ) {
				$GLOBALS[ 'TSFE' ]->getPageRenderer ()->addCssFile ( $path, 'stylesheet', 'screen', '', true, false, "", true, "|" );
			}
		}
	}
	
	/**
	 * action setMainCookie
	 * Called via AJAX to set the cookie to prevent showing the notice again.
	 *
	 * @return void
	 */
	public function setMainCookieAction() {
		$GLOBALS[ 'TSFE' ]->fe_user->setKey ( "ses", "MabCookieNoticePi1", TRUE );
		return "";
	}
}