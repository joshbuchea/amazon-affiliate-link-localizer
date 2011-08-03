<?php

/*
 * AMAZON LINK LOCALISER ajax response page
 * checks if the proposed link is valid
 *
 * @todo - use amazon api to make check - but not for wordpress version as requires api key...
 * @todo - make it work on widgets - do it on iframes' src?
 */

header("Content-type: application/javascript");

switch ( $_REQUEST['strAction'] ) {
	case 'search':
		searchLink();
		break;
	default:
		checkLinks();
		break;
}

function checkLinks() {

	// get URL
	$strTld 		= $_REQUEST['strTld'];
	$strAffiliateId = $_REQUEST['strAffiliateId'];
	$strLinks		= $_REQUEST['strLinks'];
	$arrLinks		= explode( '|', $strLinks );

	foreach ( $arrLinks as $strAsin ) {

		$strLink = "http://www.amazon.$strTld/exec/obidos/ASIN/$strAsin/$strAffiliateId";

		$arrHeaders = get_headers($strLink, 1);

		// if not found, then search for it
		if ( strpos( $arrHeaders[0], '404' ) ) {
			echo "arrLinksToCheck[ '$strAsin' ].searchLink();\n";
		} else {
			echo "arrLinksToCheck[ '$strAsin' ].localiseLink();\n";
		}

	}
}

function searchLink() {
/*
	$strHtml = '';
	$intStart = -1;

	// get item names
	while ( !strpos( $strHtml, '<title' ) ) {

		$strHtml .= file_get_contents( $_REQUEST['strLink'], false, null, $intStart, $intStart+10000 );

echo $strHtml;
		$intStart+=10000;

	}
*/
		$strHtml = file_get_contents( $_REQUEST['strLink'], false, null, -1, 100000 );

		$strPattern = '/canonical" href="http:\/\/(.*)\/(.*)\/dp\/([A-Z0-9]{10})/';


		preg_match( $strPattern, $strHtml, $arrMatches );
		$strTitle = str_replace(  '-', '%20', $arrMatches[2] );

		echo "arrLinksToCheck[ '{$arrMatches[3]}' ].writeSearchLink( '$strTitle' );\n";

}