# Front Core

Develop site-specific themes for ClassicPress, WordPress, and the antibrand system.

![Minimum PHP version 7.4](https://img.shields.io/badge/PHP_minimum-7.4-8892bf.svg?style=flat-square)
![Tested on PHP version 8.0](https://img.shields.io/badge/PHP_tested-8.0-8892bf.svg?style=flat-square)
![ClassicPress tested on version 1.2.0](https://img.shields.io/badge/ClassicPress_tested-1.2.0-03768e.svg?style=flat-square)
![WordPress tested on version 5.8](https://img.shields.io/badge/WordPress_tested-5.8-2271b1.svg?style=flat-square)
![SASS Ready](https://img.shields.io/badge/SASS-ready-bf4080.svg?style=flat-square)
![ACF Pro Ready](https://img.shields.io/badge/ACF-ready-00d3ae.svg?style=flat-square)
![Gutenberg Ready](https://img.shields.io/badge/Gutenberg-ready-00a0d2.svg?style=flat-square)
![No PHP Composer](https://img.shields.io/badge/Composer-nope-f49a36.svg?style=flat-square)
![Never AMP](https://img.shields.io/badge/AMP-Hell%20no!-005af0.svg?style=flat-square)

See [Site Core Plugin](https://github.com/ControlledChaos/sitecore) for a site-specific ClassicPress/WordPress starter plugin designed to work with Front Core.

![Front Core Screenshot](https://raw.githubusercontent.com/ControlledChaos/frontcore/master/screenshot.jpg)

## Requirements

* This theme was written in a WordPress 5.0+ environment with no concern for backwards compatibility. However, it is currently tested with no issues in ClassicPress 1.2.0.
* This theme was written on a local server running PHP 7.4
* The short array syntax ( `[]` rather than `array()` ) requires PHP 5.4+
* Class files are namespaced and the methods of which must be called accordingly in template parts.

## Build Details & Extras

* Header, navigation, and footer loaded via hook so that they may be unhooked.
* Widget to toggle light and dark themes.
* Sample theme options page ready to begin developing.
* Theme info page as an example for getting theme data.
* Bundle & load plugins by adding to the `includes/vendor` directory and extend the Plugin class.
* Fully SASS (SCSS) ready with `modules` and `partials` directories.
* Right-to-left (RTL) stylesheets are provided, and existing left-right styles are reversed.

## Advanced Custom Fields

The theme is ready to bundle a copy of Advanced Custom Fields basic or Pro. Simply add the contents of the plugin folder to the `includes/vendor/acf` directory and Advanced Custom Fields is automatically loaded, if the plugin is not active via the plugins interface.

If the `includes/vendor/acf` directory is not used as the root directory of the plugin then change the directory name, and core filename in the ACF class file properties:  
`@see includes/classes/vendor/class-acf.php`.

* There is a `before_html` hook before the opening `<html>` tag for ACF frontend forms.
* Template files look for content `template-parts` files ending with `-acf`.
* An ACF JSON directory is ready to use, filters added in the ACF class.

## Renaming, Rebranding, and Defaults

Following is a list of strings to find and replace in all theme files.

1. Plugin name  
   Find `Front_Core` and replace with your theme name, include underscores between words. This will change the namespace and the package name in file headers.

2. Text domain  
   Find `frontcore` and replace with the text domain of your theme.

3. Theme prefix
   Find `fct` and replace with the unique, lowercase theme prefix. This prefix is used for applied filters, stylesheet IDs, and admin page URIs, so the prefix may be followed by an underscore or a dash. Search for `fct_` and `fct-` to find the difference.

4. Constant prefix  
   Find `FCT` and replace with the uppercase prefix of your theme.

5. Header image  
   Find the default header image file, `default-header.jpg`, in the `assets/images/` directory and replace with your default image.

6. Activation and deactivation  
   Check the activation and deactivation classes, `includes/class-activate` and `includes/class-deactivate`, for sample methods. Remove or modify the samples as needed.

7. README file  
   Whether or not your theme will be kept in a version control repository, edit the content of the README file in the theme's root directory or delete it if it is not necessary.

## Author's Note

To all who may read this,

I hope you find this code to be easily deciphered. I have
learned much by examining the code of well written & well
documented products so I have done my best to document this
code with comments where necessary, even where not necessary,
and by using logical, descriptive names for PHP classes &
methods, HTML IDs, CSS classes, etc.

Beginners, note that the short array syntax ( `[]` rather than
`array()` ) is used. Use of the `array()` function is encouraged
by some to make the code more easily read by beginners. I argue
that beginners will inevitably encounter the short array syntax
so they may as well learn to recognize this early. If the code
is well documented then it will be clear when the brackets (`[]`)
represent an array. And someday you too will be writing many
arrays in your code and you will find the short syntax to be
a time saver. Let's not unnecessarily dumb-down code; y'all
are smart folk if you are reading this and you'll figure it out
like I did.

Greg Sweet, Controlled Chaos Design, former mule packer, cook,
landscaper, & janitor who learned PHP by breaking stuff and by
reading code comments.

## Author's Note #2

This is a note to myself as much as to anyone who may read this.
This product is a starter for my project or yours. It may contain
tools ( methods/functions, hooks, scripts ) that can speed up
development a bit but this cannot be flexible in layout and
templates and still remain a starter for a site-specific product.

There are kitchen-sink options available but they are not the
right choice and they so often need a child theme to get your
preferred template layout. So if I or you are going to write
new templates anyway we may as well start here with our own
parent theme, then create our own child themes for variation.
