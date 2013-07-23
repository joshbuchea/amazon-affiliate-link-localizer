<?php

/*
 * AMAZON LINK LOCALISER ajax response page
 * checks if the proposed link is valid
 *
 * @author Pete Williams
 * @url http://petewilliams.info
 */

//turn errors off as means one problematic link will stop everything from working
error_reporting(0);

header("Content-type: application/javascript");
header("HTTP/1.1 200 OK");

if ($_REQUEST['blnDebug']) {
	if ($_REQUEST['blnDebug'] == 1) {
		error_reporting(E_ALL ^ E_NOTICE);
	} else {
		error_reporting(E_ALL);
	}
}

$strAction = isset( $_REQUEST['strAction'] ) ? $_REQUEST['strAction'] : '';

switch ( $strAction ) {
	case 'search':
		searchLink();
		break;
	case 'version':
		echo "1.9";
		break;
	default:
		checkLinks();
		break;
}

function checkLinks() {

	// get URL
	$strAffiliateId 	= $_REQUEST['strAffiliateId'];
	$strLinks			= $_REQUEST['strLinks'];
	if ( $strLinks ) {
		$arrLinks		= explode( '|', $strLinks );
	}
	$strShortLinks		= $_REQUEST['strShortLinks'];
	if ( $strShortLinks ) {
		$arrShortLinks		= explode( '|', $strShortLinks );
	}

	// for full links, check they work
	if ( isset( $arrLinks ) && count( $arrLinks ) ) {
		foreach ( $arrLinks as $strAsin ) {
			checkAsin($strAsin, 0);
		}
	}

	// for short links, get the full links
	if ( isset( $arrShortLinks ) && count( $arrShortLinks ) ) {
		foreach ( $arrShortLinks as $strShortCode ) {

			// get full URL
			$arrHeaders = get_headers('http://amzn.to/' . $strShortCode, 1);
			$strLink = stripAffiliateId( $arrHeaders['Location'] );

			// is it a product link?
			$strPattern = '/([A-Z0-9]{10})/';
			preg_match($strPattern, $strLink, $arrMatches);

			if (count($arrMatches) && !strpos( $strLink, '/review' ) && !strpos( $strLink, '/wishlist' ) && !strpos( $strLink, "bbn=" . $arrMatches[0]) ) {
				// then check it's valid
				$strAsin = $arrMatches[0];
				checkAsin($strAsin, 1, $strShortCode, $strLink);
			} else {
				// else just affiliate
				echo "arrLinksToCheck[1][ '$strShortCode' ].arrLinkObjects[0].href = '$strLink';\n";
				echo "arrLinksToCheck[1][ '$strShortCode' ].localiseGeneralLink();\n";

			}	
		}
	}
}

function searchLink() {

		$strLink = stripAffiliateId( $_REQUEST['strLink'] );
		
		// download the first 100kb of page content 
		$strHtml = file_get_contents( 'http://' . $strLink, false, null, -1, 100000 );

		$strPattern = '/canonical" href="http:\/\/(.*)\/(.*)\/dp\/([A-Z0-9]{10})/';

		preg_match( $strPattern, $strHtml, $arrMatches );

		// if not in the first 100k, look further
		if (!count($arrMatches)) {
			$strHtml = file_get_contents( 'http://' . $strLink, false, null, -1, 150000 );
			preg_match( $strPattern, $strHtml, $arrMatches );
		}

		$strTitle = str_replace(  '-', '%20', $arrMatches[2] );

		// the canonical ASIN is sometimes different to the original one which confuses the JS, so use the one in the original link
		$strPattern2 = '/\/([A-Z0-9]{10})/';
		preg_match( $strPattern2 , $_REQUEST['strLink'], $arrUrlMatches );
		$strAsin = is_array( $arrUrlMatches ) ? $arrUrlMatches[1] : $arrMatches[3];

		// is this from a shortlink?
		$intLinkType = 0;
		$strLinkCode = $strAsin;
		if ($_REQUEST['strShortCode']) {
			$intLinkType = 1;
			$strLinkCode = $_REQUEST['strShortCode'];
		}
		echo "arrLinksToCheck[$intLinkType]['$strLinkCode' ].writeSearchLink( '$strTitle' );\n";

}

function checkAsin($strAsin, $intType, $strShortCode = null, $strLinkOriginal = null) {

		$strTld = $_REQUEST['strTld'];
		$strLink = "http://www.amazon.$strTld/exec/obidos/ASIN/$strAsin";

		$arrHeaders = get_headers($strLink, 1);
		$strObjRef = $strAsin;

		if ($strShortCode) {
			$strObjRef = $strShortCode;
			echo "arrLinksToCheck[$intType][ '$strObjRef' ].strAsin = '$strAsin';\n";
			echo "arrLinksToCheck[1][ '$strShortCode' ].arrLinkObjects[0].href = '$strLinkOriginal';\n";
		}

		// if not found, then search for it
		if ( strpos( $arrHeaders[0], '404' ) || strpos( $arrHeaders[1], '404' ) ) {
			echo "arrLinksToCheck[$intType][ '$strObjRef' ].searchLink(" . ($strShortCode ? "'$strShortCode'" : '') . ");\n";
		} else {
			echo "arrLinksToCheck[$intType][ '$strObjRef' ].localiseLink();\n";
		}
}

// strip the affiliate ID before checking, don't want to register false impressions which would decrease the reported conversion rate
function stripAffiliateId( $strLink ) {

	// Strip out tag=… affiliate tags (because I can't get regex to work!)
	$intPreTag = strpos( $strLink, "tag=" );
	if ( $intPreTag ) {
		$intPreTag += 4;
		$intPostTag = strpos( $strLink, "&", $intPreTag );

		if ( !$intPostTag ){
			$intPostTag = strlen( $strLink );
		}
	
		$strLink = str_replace( 'tag=' . substr( $strLink, $intPreTag, $intPostTag - $intPreTag ), '', $strLink );
	} else {

		// Strip out affiliate IDs from direct ASIN links
		$strPatternTag = "/(asin|dp|product)\/[A-Z0-9]{10}\/([^\/^\?]*)(\?.*|\/.*|$)/i";
		preg_match( $strPatternTag, $strLink, $arrMatchesTag );
		if ( count( $arrMatchesTag ) && $arrMatchesTag[2] ) {
			$strLink = str_replace( '/'.$arrMatchesTag[2], '', $strLink );
		}
	}
	return $strLink;
}