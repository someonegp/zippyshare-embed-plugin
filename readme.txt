=== ZippyShare Embed ===
Contributors: BaconCZE
Tags: embed, embedding, zippy, zippyshare, audio, mp3, shorttag
Requires at least: 2.7
Tested up to: 3.0.1
Stable tag: trunk

This plugin adds a shorttag for embedding ZippyShare audio files.

== Description ==

This plugin adds a shorttag for embedding ZippyShare audio files.

Since version 1.1 you should use it like this: [zippyshare width=680 fcolor=00000 lcolor=000000 bcolor=ffffff volume=80]http://www39.zippyshare.com/v/34497688/file.html[/zippyshare], where all parameters are optional and when not specified, the default values from settings are used. Sometimes the width isn't accurate (for example: for 620px player results from 618px settings).

This way: [zippyshare www=www39 width=680 fcolor=000000 lcolor=000000 bcolor=ffffff volume=80]file-id[/zippyshare] is still supported, but will not be developed in future. Width, fcolor, lcolor, bcolor and volume are optional parameters. If you do not specify them, the values set in settings page are used.

Variable file-id can be found in the URL, for example: http://www39.zippyshare.com/v/34497688/file.html . That 34497688 is video-id and subdomain www39 is server number, which are needed to paste between [zippyshare www=www39] and [/zippyshare].

== Installation ==

1. Extract the contents of the archive (zip file)
2. Upload the zippyshare-embed folder to your 'wp-content/plugins' folder
3. Activate the plugin through the Plugins section in your WordPress admin
4. You can set your own default dimensions by setting them up on the settings page 
5. Use the [zippyshare][/zippyshare] shortcode as described above

== Frequently Asked Questions ==

= Will you provide more useful embed shorttags? =

Probably not. There is too much plugins, which do their jobs really well. I just missed some with ZippyShare included, so I did it myself.

== Changelog ==

= 1.1 =
* Shortcode using changed
* Misc. changes in code

= 1.0 =
* Initial release, so there are not changes

== Upgrade Notice ==

= 1.1 =
New shortcode using.

= 1.0 =
Initial release, so there is not upgrade notice.