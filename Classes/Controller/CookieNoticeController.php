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
	 * Either use Typo3-Session or a Cookie.
	 * @var string $cookieMode
	 */
	protected $cookieMode = "cookie";
	
	/**
	 * Lifetime of a Cookie in days
	 * @var integer $cookieLifetime
	 */
	protected $cookieLifetime = 365;
	
	/**
	 * action main
	 * Shows the cookie notice
	 *
	 * @return void
	 */
	public function mainAction() {
		// set some settings...
		// ... cookieMode - either session or cookie
		if (isset ( $this->settings[ 'cookieMode' ] ) && in_array ( $this->settings[ 'cookieMode' ], [ 
				"session",
				"cookie" 
		] )) {
			$this->cookieMode = $this->settings[ 'cookieMode' ];
		}
		
		// cookieLifetime in days, if cookieMode is cookie
		if ($this->cookieMode == "cookie" && isset ( $this->settings[ 'cookieLifetime' ] ) && ( integer ) $this->settings[ 'cookieLifetime' ] > 0) {
			$this->cookieLifetime = ( integer ) $this->settings[ 'cookieLifetime' ];
		}
		
		// differentiate between session and cookie
		if ($this->cookieMode == "session") {
			if ($this->request->hasArgument ( "setMainCookie" )) {
				// Called via AJAX to set the cookie to prevent showing the notice again.
				$GLOBALS[ 'TSFE' ]->fe_user->setKey ( "ses", "MabCookieNoticePi1", TRUE );
				return "";
			}
			
			// if cookie is allready set show nothing ...
			if ($GLOBALS[ "TSFE" ]->fe_user->getKey ( "ses", "MabCookieNoticePi1" )) {
				// ... or include Google Analytics if enabled
				if (( boolean ) $this->settings[ 'analytics' ][ 'enable' ]) {
					$this->forward ( "googleAnalytics" );
				}
				return "";
			}
		} else {
			if ($this->request->hasArgument ( "setMainCookie" )) {
				// Called via AJAX to set the cookie to prevent showing the notice again.
				setcookie ( "MabCookieNoticePi1", "allreadyShown", time () + 3600 * 24 * $this->cookieLifetime, "/" );
				return "";
			}
			
			// if cookie is allready set show nothing ...
			if (isset ( $_COOKIE[ "MabCookieNoticePi1" ] ) && $_COOKIE[ "MabCookieNoticePi1" ] == "allreadyShown") {
				// ... or include Google Analytics if enabled
				if (( boolean ) $this->settings[ 'analytics' ][ 'enable' ]) {
					$this->forward ( "googleAnalytics" );
				}
				return "";
			}
		}
		
		// Default-functionality: add Stylesheet files and show message
		if (isset ( $this->settings[ 'includes' ][ 'StyleSheets' ] ) && is_array ( $this->settings[ 'includes' ][ 'StyleSheets' ] )) {
			foreach ( $this->settings[ 'includes' ][ 'StyleSheets' ] as $path ) {
				$GLOBALS[ 'TSFE' ]->getPageRenderer ()->addCssFile ( $path, 'stylesheet', 'screen', '', true, false, "", true, "|" );
			}
		}
	}
	
	/**
	 * action googleAnalytics
	 *
	 * @return void
	 */
	public function googleAnalyticsAction() {
		if (( boolean ) $this->settings[ 'analytics' ][ 'enable' ]) {
			$GLOBALS[ 'TSFE' ]->getPageRenderer ()->addJsFooterInlineCode ( "mab_cookie_notice googleAnalytics", $this->view->render () );
		}
		return "";
	}
	
	/**
	 * action googleAnalyticsOptOut
	 *
	 * @return void
	 */
	public function googleAnalyticsOptOutAction() {
	}
}
