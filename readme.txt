=== Amazon Affiliate Link Localizer ===
Contributors: Pete Williams
Tags: amazon, links, javascript, associate, affiliate, associates, affiliate, amazon, ecommerce, money, internet marketing, earn money, revenue, widget, post, admin, plugin, posts, links, page
Tested up to: 3.2.1
Requires at least:  2.0
Stable tag: 1.5.1
Donate link: http://petewilliams.info/donate

This plugin automatically changes your Amazon links to point to your visitor's local Amazon store whilst using your affiliate ID for that country

== Description ==
This plugin not only automatically changes any Amazon link on your site to use your affiliate ID, but it also changes the link to point to the user's local Amazon store. 

So if your visitor is visiting from the UK they'll get a link to Amazon.co.uk, if they're visiting from the US they'll get a link to the same product on Amazon.com.

All you have to do is provide all your affiliate IDs.

It doesn't matter if the link is in your post, in your template or anywhere else on your page - it'll be converted automatically.

If you find this plugin helpful and it's increasing your sales. please consider [donating just $1](http://petewilliams.info/donate) or more to say thanks for the many many hours I've spent on it. I'd really appreciate it!

Disclosure:
If you don't have an affiliate account with one of the Amazon counties and leave its setting blank, the script will use mine. It'll never overwrite your affiliate IDs though, so don't worry - you'll never lose any revenue.

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
* Prevented JavaScript error from occuring if Google's API fails or cannot provide a location
* Added support for Italian and and Chinese Amazon sites

= 1.5.1 =
* Bug fix - the search redirects were not working properly

== Upgrade Notice ==

= 1.5 =
Increase your conversion rate with the latest version. Support for new Amazon sites added. It also now searches by title for any items not found with the same product ID.

= 1.5.1 = 
Bug fix: upgrade immediately to increase conversions.

== Frequently Asked Questions ==

= I've installed the plugin, but the links aren't changing =

To ensure it doesn't slow your site down the script waits until everything else is loaded before running. Make sure the page is fully loaded before checking your links.

= Does it work with Amazon Widgets? =

Not yet. Most of the widgets work by embedding iframes into your page. The script cannot access the links as they are actually on Amazon's page not yours. I'm looking at adding support for these in a future version. Install it anyway though - it will work with your normal links and won't do your widgets any harm.

= Does it work with Wordpress plugin x? =

I've not tried them all, so I really don't know! Give it a go, it can't do any harm. Basically it should work with any Amazon link that is in the HTML of the page. If it's embedded in an iframe. Flash or anything outside your own HTML it will not work.

= The links are not changing country for me =

The script uses a Google API for determining your country from your IP address. Sometimes - not very often, probably less than 0.5% of the time - Google cannot determine your country. In this instance, the script will affiliate but not localise your links. Don't worry though, even if this happens to you, it'll be fine for 99% of your users!

= Why do my links go to a search result page, not straight to the product

The script works by looking at product IDs. If the product exists on the local site with the same ID, then it'll link to there. If not, it will get the item's name and link to a search results page for it. This means that, for example, even though the UK and US PlayStation 3s are technically different models as they have different plugs etc the user will still get a link to a PS3.

= My, what a delightful plugin, and it's free? Wow, you're too kind - can I buy you a pint?

You most certainly can you kind and gracious soul! There is a PayPal donation form here and I promise to spend all proceeds on beer: http://petewilliams.info/donate