=== Amazon Affiliate Link Localizer ===
Contributors: Pete Williams
Tags: amazon, links, affiliate, associates, affiliate, amazon, affiliate marketing, ecommerce, javascript, associate, money, internet marketing, earn money, revenue, widget, post, admin, plugin, posts, links, page
Tested up to: 3.5.2
Requires at least:  2.0
Stable tag: 1.9
Donate link: http://petewilliams.info/donate

This plugin automatically changes your Amazon links to point to your visitor's local Amazon store whilst using your affiliate ID for that country

== Description ==
This plugin not only automatically changes any Amazon link on your site to use your affiliate ID, but it also changes the link to point to the user's local Amazon store. 

So if your visitor is visiting from the UK they'll get a link to Amazon.co.uk, if they're visiting from the US they'll get a link to the same product on Amazon.com.

All you have to do is provide all your affiliate IDs.

It doesn't matter if the link is in your post, in your template or anywhere else on your page - it'll be converted automatically.

If you find this plugin helpful and it's increasing your sales, please consider [donating just £1](http://petewilliams.info/donate) or more to say thanks for the many, many hours I've spent on it. I'd really appreciate it!

Disclosure:
If you don't have an affiliate account with one of the Amazon countries and leave its setting blank, the script will use mine. It'll never overwrite your affiliate IDs though, so don't worry - you'll never lose any revenue.

== Non-Wordpress version ==

If you want to achieve the same result on a non-Wordpress site, you can simply install the [JavaScript version](http://petewilliams.info/blog/2009/07/javascript-amazon-associate-link-localiser)

== Installation ==

1. Upload the `amazon_affiliate_link_localizer` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Enter your Affiliate IDs under the settings page

== Changelog ==

= 1.0 =
* Initial release

= 1.1 =
* Revised readme.txt

= 1.2 =
* Fixed bug in load order of JS dependencies

= 1.3 =
* Now checks to see if your local Amazon store sells the product and only redirects link if it does
* Now works for all Amazon links, not just direct product links

= 1.4 =
* Now named 1.5 as 1.4 was corrupted when uploaded to Wordpress.

= 1.5 =
* If you local Amazon store does not sell the product with the same product ID, the script now redirects to a search results page searching for the item's title
* Prevented JavaScript error from occurring if Google's API fails or cannot provide a location
* Added support for Italian and Chinese Amazon sites

= 1.5.1 =
* Bug fix - the search redirects were not working properly

= 1.6 =
* Added a fallback geolocation service in case the Google API fails

= 1.6.1 =
* Updated to reflect a change in how Amazon now handles 404 errors to ensure the correct link is used
* Fixed bug where multiple links to the same page were not all changed.
* Fixed bug for items that had a different canoconical ASIN form that used in the original link

= 1.7 =
* Added support for new Spanish Amazon.es site

= 1.7.1 =
* Added workaround for sites with poorly formed URL rewrites

= 1.7.2 =
* Fixed bug that meant that some local sites weren't being redirected to if an ID wasn't supplied for it.

= 1.7.3 =
* Fixed support for artist links
* Increased click report accuracy by stripping affiliate tags from AJAX product checks
* Redirected Swiss users to Amazon Germany

= 1.7.4 =
* Fixed a bug which was incorrectly redirecting wishlist links.
* Fixed a bug which was incorrectly redirecting local.amazon.com links.

= 1.8 =
* Added support for Amazon short links (http://amzn.to/)
* Increased click report accuracy by stripping affiliate tags from AJAX product name lookups

= 1.8.1 =
* Fixes a bug in version 1.8

= 1.8.2 =
* Fixed a short links bug - repeated amzn.to were only being changed the first time they appeared

= 1.8.3 =
* Performance optimisation, security tightening, code improvements
* Added version number to javascript src to enable far-future browser caching
* Added Jersey/Guernsey/Isle of Mann support

= 1.9 =
* Added support for Amazon India
* Added support for links to coupons
* Added support for links directly to images, as used by light boxes
* Fixed certain wishlist links
* Extended the search for product titles when not found in initial search

== Upgrade Notice ==

= 1.5 =
Increase your conversion rate with the latest version. Support for new Amazon sites added. It also now searches by title for any items not found with the same product ID.

= 1.5.1 = 
Bug fix: upgrade immediately to increase conversions.

= 1.6 = 
Dramatically improved geolocation accuracy by adding a secondary geolocation service as a fallback for when the Google geolocation API is unable to detect someone's location.

= 1.6.1 =
Important updated to reflect a change in how Amazon now handles 404 errors. Update to ensure the correct link is always used.

= 1.7 =
Added support for new Spanish Amazon.es site

= 1.7.1 =
Added workaround for sites with poorly formed URL rewrites which prevents some links from changing

= 1.7.2 =
Fixed bug that meant that some local sites weren't being redirected to if an ID wasn't supplied for it.

= 1.7.3 =
Various minor improvements and fixes. Upgrade now to increase your conversion rates.

= 1.7.4 =
Minor bug fixes to fix some more obscure links

= 1.8 = 
Important update to prevent behind-the-scenes URL calls from logging against your affiliate ID. Upgrade now to increase your conversion rates.

= 1.8.1 =
Bug fix to previous version. Urgent update

= 1.8.2 =
Minor bug fix - only effects repeated amzn.to links

= 1.8.3 =
Maintenance release. Updated recommended.

= 1.9 =
Added support for new Amazon India site (Amazon.in) and made various other improvements and fixes. Important update. 

== Frequently Asked Questions ==

= My, what a delightful plugin, and it's free? Wow, you're too kind - can I buy you a pint? =
You most certainly can you kind and gracious soul! There is a PayPal donation form here and I promise to spend all proceeds on beer: http://petewilliams.info/donate

= I've installed the plugin, but the links aren't changing =

To ensure it doesn't slow your site down the script waits until everything else is loaded before running. Make sure the page is fully loaded before checking your links.

= Why do my links go to a search result page, not straight to the product =

The script works by looking at product IDs. If the product exists on the local site with the same ID, then it'll link to there. If not, it will get the item's name and link to a search results page for it. This means that, for example, even though the UK and US PlayStation 3s are technically different models as they have different plugs etc the user will still get a link to a PS3.

= Does it work with Amazon Widgets? =

Not yet. Most of the widgets work by embedding iframes into your page. The script cannot access the links as they are actually on Amazon's page not yours. I'm looking at adding support for these in a future version. Install it anyway though - it will work with your normal links and won't do your widgets any harm.

= Does it work with Wordpress plugin x? =

I've not tried them all, so I really don't know! Give it a go, it can't do any harm. Basically it should work with any Amazon link that is in the HTML of the page. If it's embedded in an iframe, Flash or anything outside your own HTML it will not work.

= Are there any links that don't get localized? = 
Wishlist links aren't localised as a wishlist only exists on the site you built it on. Links to Amazon's Groupon clone (AmazonLocal) are also not affiliated because there is only a US site and it is not covered by the affiliate scheme.