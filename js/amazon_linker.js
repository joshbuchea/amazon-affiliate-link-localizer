/*v1.9*/
var arrLinksToCheck = [
    [],
    []
];
var strTld;
var strAffiliateId;

function linkAmazon(objLink, strAsin) {
    this.arrLinkObjects = new Array(objLink);
    if (strAsin) {
        this.strAsin = strAsin;
    }
    this.affiliateLink = function() {
        for (intLink = 0; intLink < this.arrLinkObjects.length; intLink++) {
            this.arrLinkObjects[intLink].href = "http://www.amazon." + this.getActualTld() + "/exec/obidos/ASIN/" + this.strAsin + "/" + getAffiliateId(arrTldActual[1]);
        }
    };
    this.searchLink = function(strShortCode) {
        var objRegexTitle = new RegExp("amazon.[a-zA-Z.]{2,5}/([A-Za-z-]*)/dp");
        arrResult = objRegexTitle.exec(this.arrLinkObjects[0].href);
        if (arrResult) {
            strTitle = arrResult[1].replace(/-/g, "%20");
            this.writeSearchLink(strTitle);
        } else {
            strUrlProduct = strUrlAjax + "?strAction=search&strLink=" + this.arrLinkObjects[0].href.replace('http://', '').replace('&', '%26');
            if (strShortCode) {
                strUrlProduct += "&strShortCode=" + strShortCode;
            }
            objScript = document.createElement("script");
            objScript.src = strUrlProduct;
            document.getElementsByTagName("head")[0].appendChild(objScript);
        }
    };
    this.addLink = function(objLink) {
        this.arrLinkObjects.push(objLink);
    };
    this.writeSearchLink = function(strTitle) {
        for (intSearchLink = 0; intSearchLink < this.arrLinkObjects.length; intSearchLink++) {
            this.arrLinkObjects[intSearchLink].href = "http://www.amazon." + strTld + "/s?keywords=" + strTitle + "&tag=" + strAffiliateId;
        }
    };
    this.localiseGeneralLink = function() {
        for (var i = 0; i < this.arrLinkObjects.length; i++) {
            this.arrLinkObjects[i].href = this.arrLinkObjects[0].href;
            var intPreTag = this.arrLinkObjects[i].href.indexOf("tag=");
            if (!strTld || this.arrLinkObjects[i].href.indexOf("/wishlist/") > 0 || this.arrLinkObjects[i].href.indexOf("=wishlist") > 0 || this.arrLinkObjects[i].href.indexOf("/review") > 0 || this.arrLinkObjects[i].href.indexOf("/coupon") > 0) {
                strTldChecked = this.getActualTld();
            } else {
                strTldChecked = strTld;
            }
            if (intPreTag > 0) {
                intPreTag += 4;
                var intPostTag = this.arrLinkObjects[i].href.substring(intPreTag).indexOf("&");
                if (intPostTag < 0) {
                    intPostTag = this.arrLinkObjects[i].href.length - intPreTag;
                }
                this.arrLinkObjects[i].href = this.arrLinkObjects[i].href.substring(0, intPreTag) + getAffiliateId(strTldChecked) + this.arrLinkObjects[i].href.substring((intPostTag + intPreTag));
                intPath = this.arrLinkObjects[i].href.indexOf("/", this.arrLinkObjects[i].href.indexOf("amazon"));
                this.arrLinkObjects[i].href = "http://www.amazon." + strTldChecked + this.arrLinkObjects[i].href.substring(intPath);
            } else {
                intPath = this.arrLinkObjects[i].href.indexOf("/", this.arrLinkObjects[i].href.indexOf("amazon"));
                this.arrLinkObjects[i].href = this.arrLinkObjects[i].href.substring(0, this.arrLinkObjects[i].href.indexOf("amazon.")) + "amazon." + strTldChecked + this.arrLinkObjects[i].href.substring(intPath) + (this.arrLinkObjects[i].href.indexOf("?") > 0 ? "&" : "?") + "tag=" + getAffiliateId(strTldChecked);
            }
        }
    };
    this.getAffiliateUrl = function() {
        return "http://www.amazon." + strTld + "/exec/obidos/ASIN/" + this.strAsin + "/" + strAffiliateId;
    };
    this.localiseLink = function() {
        for (i = 0; i < this.arrLinkObjects.length; i++) {
            this.arrLinkObjects[i].href = this.getAffiliateUrl();
        }
    };
    this.getActualTld = function() {
        var c = new RegExp("amazon.(.*?)/");
        arrTldActual = c.exec(this.arrLinkObjects[0].href);
        return arrTldActual[1];
    };
}

function findLocation() {
    if (typeof google != "undefined" && google.loader.ClientLocation !== null) {
        var strCountry = google.loader.ClientLocation.address.country_code;
        checkAmazonLinks(strCountry);
    } else {
        objScript = document.createElement("script");
        objScript.src = "http://freegeoip.net/json/?callback=checkAmazonLinks";
        document.getElementsByTagName("head")[0].appendChild(objScript);
    }
}

function checkAmazonLinks(strCountry) {
    var objRegexAsin = new RegExp("(?!/e|st)../([A-Z0-9]{10})");
    if (strCountry) {
        if (typeof strCountry.country_code != "undefined") {
            strCountry = strCountry.country_code;
        }
        switch (strCountry) {
            case 'GB':
            case 'JE':
            case 'GG':
            case 'IM':
            case 'IE':
                strTld = 'co.uk';
                break;
            case 'CH':
            case 'AT':
                strTld = 'de';
                break;
            case 'PT':
                strTld = 'es';
                break;
            case 'PK':
            case 'BD':
                strTld = 'in';
                break;
            default:
                strTld = (arrAffiliates[strCountry.toLowerCase()] !== null ? strCountry.toLowerCase() : 'com');
                break;
        }
        strAffiliateId = getAffiliateId(strTld);
    }
    var arrLinks = document.getElementsByTagName("a");
    for (var i = 0, j = arrLinks.length; i < j; i++) {
        var intIndex = arrLinks[i].href.toLowerCase().indexOf("amazon.");
        if (intIndex > 0 && intIndex < arrLinks[i].href.substring(8).indexOf("/") + 8 && arrLinks[i].href.substring(intIndex - 6, intIndex - 1) != 'local' && arrLinks[i].href.substring(intIndex - 7, intIndex) != 'images-') {
            var arrResults = objRegexAsin.exec(arrLinks[i].href);
            if (arrResults && arrLinks[i].href.indexOf("/review/") < 0 && arrLinks[i].href.indexOf("/wishlist/") < 0 && arrLinks[i].href.indexOf("=wishlist") < 0 && arrLinks[i].href.indexOf("/coupon") < 0) {
                if (typeof(arrLinksToCheck[0][arrResults[1]]) == "undefined") {
                    objLink = new linkAmazon(arrLinks[i], arrResults[1]);
                    if (strTld && strTld == objLink.getActualTld()) {
                        objLink.affiliateLink();
                    } else {
                        arrLinksToCheck[0][arrResults[1]] = objLink;
                    }
                } else {
                    arrLinksToCheck[0][arrResults[1]].addLink(arrLinks[i]);
                }
            } else {
                objLink = new linkAmazon(arrLinks[i]);
                objLink.localiseGeneralLink();
            }
        } else if (arrLinks[i].href.toLowerCase().indexOf("amzn.to") > 0) {
            strShortCode = arrLinks[i].href.substr(arrLinks[i].href.indexOf("amzn.to") + 8);
            if (typeof(arrLinksToCheck[1][strShortCode]) == "undefined") {
                objLink = new linkAmazon(arrLinks[i]);
                arrLinksToCheck[1][strShortCode] = objLink;
            } else {
                arrLinksToCheck[1][strShortCode].addLink(arrLinks[i]);
            }
        }
    }
    if (strTld) {
        var strLinksToCheck = "";
        var strShortLinksToCheck = "";
        for (var strKey in arrLinksToCheck[0]) {
            if (arrLinksToCheck[0].hasOwnProperty(strKey) && typeof arrLinksToCheck[0][strKey].strAsin != "undefined") {
                strLinksToCheck += arrLinksToCheck[0][strKey].strAsin + "|";
            }
        }
        for (strKey in arrLinksToCheck[1]) {
            if (arrLinksToCheck[1].hasOwnProperty(strKey)) {
                strShortLinksToCheck += strKey + "|";
            }
        }
        if (strLinksToCheck.length || strShortLinksToCheck.length) {
            var strUrlAjaxLinks = strUrlAjax + "?strTld=" + strTld + "&strAffiliateId=" + strAffiliateId + "&strLinks=" + strLinksToCheck.substring(0, strLinksToCheck.length - 1) + "&strShortLinks=" + strShortLinksToCheck;
            strUrlAjaxLinks = strUrlAjaxLinks.substring(0, strUrlAjaxLinks.length - 1);
            objScript = document.createElement("script");
            objScript.src = strUrlAjaxLinks;
            document.getElementsByTagName("head")[0].appendChild(objScript);
        }
    }
}

function getAffiliateId(strTLD) {
    return (arrAffiliates[strTLD] ? arrAffiliates[strTLD] : arrAffiliatesSpares[strTLD]);
}
if (window.addEventListener) {
    window.addEventListener("load", findLocation, false);
} else {
    window.attachEvent("onload", findLocation);
}
var arrAffiliatesSpares = {
    'co.uk': 'petewill08-21',
    'com': 'petewill-20',
    'de': 'petewill05-21',
    'fr': 'petewill-21',
    'ca': 'petewill00-20',
    'co.jp': 'petewill-22',
    'jp': 'petewill-22',
    'it': 'petewill04-21',
    'cn': 'petewill-23',
    'es': 'petewill0d4-21',
    'in': 'petewill0e8-21'
};