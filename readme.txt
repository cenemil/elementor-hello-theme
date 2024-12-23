=== Jtheme Jello ===
Contributors: Jezweb
Requires at least: WordPress 6.0.0
Tested up to: WordPress 6.6.0
Version: 1.4.9.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Customized elementor Hello Theme in a simplified and convenient manner and best used with Elementor plugin. Developed by Jezweb to achieve a subtle and clean Wordpress dashboard, Customizer and avoid other plugin dependencies.

For more information about Jtheme Jello please go to https://github.com/cenemil/elementor-hello-theme.

Child theme is also available at https://github.com/cenemil/jtheme-jello-child.

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Click 'Upload Theme', choose file and install.
3. Click on the 'Activate' button to use your new theme right away.
5. Navigate to Appearance > Customize in your admin panel and customize to taste.

Jtheme Jello bundles the following third-party resources:

Elementor (Pro)
Source: https://elementor.com

== Changelog ==

= 1.4.9.1 - 2024-12-9 =
* Tweak: Theme version constant added and used for the usage tracker

= 1.4.9 - 2024-12-2 =
* New: Settings for disabling Elementor AI functionality (General Settings -> Elementor)
* New: Settings for disabling Elementor notices (General Settings -> Elementor)
* New: Microsoft Clarity (Header Hooks -> Microsoft Clarity)
* New: Theme usage tracker
* Fix: Disable Gutenberg fullscreen view for all users(JS code issue)
* Fix: Disable comments code moved to "/includes" folder

= 1.4.8 - 2024-8-3 =
* Fix: Undefined property "title" of WP Admin bar user account node
* Fix: Media library file size column width

= 1.4.7 - 2023-12-4 =
* New: Media library file size column
* New: Settings for disabling auto-update email notifications of WP Core, Themes and Plugins (General Settings -> Emails)

= 1.4.6 - 2023-4-23 =
* New: Post/Page content duplicator feature
* New: Login error message customized
* Fix: Undefined object on page edit nodes
* Fix: Added CSS snippet for mobile usability issues(SEO)

= 1.4.5 - 2021-7-6 =
* New: Hide Jetpack notice (Woocommerce Services plugin)
* New: Hide Elementor usage tracking notice
* New: Login screen logo height and width settings
* Fix: Login screen logo display issue

= 1.4.4 - 2021-4-5 =
* Fix: Elementor gallery line css fix
* Fix: button, input, optgroup, select, textarea tags font-family and font-size set to inherit

= 1.4.3 - 2021-3-27 =
* Fix: login_headertitle fix deprecated to "login_headertext"
* Fix: "div.gform_wrapper form" font-family declaration set to inherit
* New: Disable auto-update email notifications for plugins
* New: Hide Backup Guard plugin review banner
* Tweak: Hide Elementor switch mode button for default Wordpress editor
* Tweak: Disable Gutenberg fullscreen view for all users

= 1.4.2 - 2020-8-30 =
* New: Theme styles toggle for global elements and Gravity forms

= 1.4.1 - 2020-1-29 =
* Fix: Gutenberg options reverted to version 1.3.3

= 1.4 - 2020-1-23 =
* New: Woocommerce sort option (Alphabetical)
* New: GTM code for header and body tag (Customizer -> Header Hooks)
* New: Body tag opening hook (wp_body_open)
* Tweak: Hide the rank math box in dashboard
* Tweak: Hide Yith announcements and Yith blog
* Tweak: Imagify plugin admin menu bar item removed
* Tweak: Button styles - default and hover
* Tweak: Global line height setting for body elements
* Tweak: Elementor form button cursor set to pointer attribute
* Fix: Add double quote wrappers for Google font declaration (Font settings)
* Fix: Disable Gutenberg for page but enabled by default for post

= 1.3.3 - 2019-4-17 =
* New: Disable html comment promoting math rank
* New: Gutenberg editor functionality option
* Tweak: Plugins and Tools dashboard menu items back to their original position
* Fix: Unknown variable value "text_domain" due to wrong declaration in the customizer settings

= 1.3.2 - 2019-2-9 =
* New: Added submenu items of Plugins in Admin Settings menu
* New: Login Screen added to WP Customizer under General Settings with background color and site logo background color options
* Tweak: Toggle site logo override in WP login
* Tweak: Page Settings link added for Page screens toolbar
* Fix: Toolbar recent tweaks are applicable only to Administrator roles

= 1.3.1 - 2019-1-22 =
* New: WP dashboard link added in front-end view (top-left cog icon)
* Tweak: Edit with Elementor link tweak specific to page post type only
* Tweak: Edit post entry link is enabled
* Tweak: Admin Settings menu will be opened when accessing Plugins and Tools(sub-menus) menu
* Tweak: Line break appended at WP admin footer text

= 1.3 - 2019-1-19 =
* Fix: svg format logo is supported in the Wordpress login page and alignment issue is fixed
* Tweak: Toolbar tidy-up - removed most of the items leaving Menus link, Elementor edit link and Profile link
* Tweak: Admin menu re-order - Plugins and Tools moved to Settings

= 1.2.2 - 2018-12-20 =
* Fix: jQuery error - dequeue script of Wordpress jQuery library and enqueue it to the header for dependencies validity

= 1.2.1 - 2018-12-13 =
* New: Page content width added in WP Customizer (General Settings -> Body -> Page Content)
* Tweak: Update checker URL adjustments due to invalid protocol declaration

= 1.2 - 2018-12-11 =
* New: Added clear fix CSS
* New: Elementor dashboard notice/message disabled
* New: Gravity forms default styles (fields, labels, button)
* New: Gravity forms customizer settings
* Tweak: Customizer additional styles via controls enqueue
* Tweak: Customizer setting tweaks(front and backend)
* Fix: Body overflow hidden(horizontal scrolling)
* Fix: Page header disabled by default

= 1.1 - 2018-11-20 =
* New: Parent theme configured and standard child theme added

= 1.0.2 - 2018-11-18 =
* New: WP Update server configured(server)

= 1.0.1 - 2018-11-16 =
* New: Theme update checker configured(server)

= 1.0 - 2018-11-15 =
* New: First dry-run of Jello theme

Initial release
