=== Amazon Affiliate Link Localizer ===
Contributors: Pete Williams
Tags: amazon, links, javascript, associate, affiliate, associates, affiliate, amazon, ecommerce, money, internet marketing, earn money, revenue, widget, post, admin, plugin, posts, links, page
Tested up to: 3.1.2
Requires at least:  2.0
Stable tag: 1.4
Donate link: http://petewilliams.info/donate

This plugin automatically changes your Amazon links to point to your visitor's local Amazon store whilst using your affiliate ID for that country.

== Description ==
This plugin not only automatically changes any Amazon link on your site to use your affiliate ID, but it also changes the link to point to the user's local Amazon store. 

So if your visitor is visiting from the UK they'll get a link to Amazon.co.uk, if they're visiting from the US they'll get a link to the same product on Amazon.com.

All you have to do is provide all your affiliate IDs.

It doesn't matter if the link is in your post, in your template or anywhere else on your page - it'll be converted automatically.

If you find this plugin helpful and it's increasing your sales. please consider [donating just $1](http://petewilliams.info/donate) or more to say thanks for the many many hours I've spent on it. I'd really appreciate it!

Disclaimer:
If you don't have an affiliate account with one of the Amazon counties amd leave it's setting blank, the script will use mine. It'll never overwrite your affiliate IDs though, so don't worry - you'll never lose any revenue.

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
* If you local Amazon store does not sell the product with the same product ID, the script now redirects to a search results page searching for the item's title
* Prevented JavaScript error from occuring if Google's API fails or cannot provide a location
* Added support for Italian and and Chinese Amazon sites

== Upgrade Notice ==

= 1.4 =
Increase your conversion rate with the latest version. Support for new Amazon sites added. It also now searches by title for any items not found with the same product ID.

== Frequently Asked Questions ==

= I've installed the plugin, but the links aren't changing =

To ensure it doesn't slow your site down the script waits until everything else is loaded before running. Make sure the page is fully loaded before checking your links.

= Does it work with Amazon Widgets? =

Not yet. Most of the widgets work by embedding iframes into your page. The script cannot access the links as they are actually on Amazon's page not yours. I'm looking at adding support for these in a future version. Install it anyway though - it will work with your normal links and won't do your widgets any harm.

= Does it work with Wordpress plugin x? =

I've not tried them all, so I really don't know! Give it a go, it can't do any harm. Basically it should work with any Amazon link that is in the HTML of the page. If it's embedded in an iframe. Flash or anything outside your own HTML it will not work.