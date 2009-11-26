<?php

/*
 * AMAZON LINK LOCALISER ajax response page
 * checks if the proposed link is valid
 *
 * @todo - use amazon api to make check - but not for wordpress version as requires api key...
 * @todo - test, test, test!
 * @todo - make it work on widgets - do it on iframes' src?
 * @todo - for wordpress version, should be able to host PHP file locally and do a traditional ajax call
 */

header("Content-type: application/javascript");

// get URL
$strTld 		= $_REQUEST['strTld'];
$strAffiliateId = $_REQUEST['strAffiliateId'];
$strLinks		= $_REQUEST['strLinks'];
$arrLinks		= explode( '|', $strLinks );

foreach ( $arrLinks as $strAsin ) {

	$strLink = "http://www.amazon.$strTld/exec/obidos/ASIN/$strAsin/$strAffiliateId";

	$arrHeaders = get_headers($strLink, 1);

	if ( strpos( $arrHeaders[0], '404' ) ) {
		echo "arrLinksToCheck[ '$strAsin' ].affiliateLink();\n";
	} else {
		echo "arrLinksToCheck[ '$strAsin' ].localiseLink();\n";
	}

}