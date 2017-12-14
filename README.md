# Webpack Boilerplate


## Getting Started

Welcome to the Genesis child theme boilerplate. This starter kit adds webpack, Bootstrap 4 and some useful WordPress helpers to your child theme.

### Requirements

You will need to have a copy of node.js installed and updated.
https://nodejs.org/en/

This project uses webpack for its installation. 
https://webpack.js.org/guides/installation/

Boilerplate assumes you already have a copy of the genesis framework in your themes folder.
https://my.studiopress.com/themes/genesis/

### First Time Setup

Boilerplate is used to get a Genesis child theme up and running quickly.

In the steps below `my-child-theme` is used as an example. This should be replaced with your child theme folder.

1. `cd wp-content/themes`
2. `mkdir my-child-theme`
3. `cd my-child-theme`
4. `git clone https://github.com/pressden/wp-boilerplate.git boilerplate`
5. `cp -r boilerplate/childtheme/* .`
6. Edit `style.css` (line 2) to identify your theme in WordPress
7. Edit `functions.php` (line 10) to identify your theme in Genesis
8. `cd boilerplate`
9. `npm install`

That's it! Proceed to the next section to learn more about running webpack.


### Running Webpack via NPM

In the steps below `my-child-theme` is used as an example. This should be replaced with your child theme folder.

1. `cd wp-content/themes/my-child-theme/boilerplate`
2. Use one of the following commands to compile the project
..* `npm start` will compile the project once
..* `npm run watch` will watch the project and compile any time a change is detected

### Child Theme Structure

When setting up a project for the first time several files are copied from WP-Boilerplate into your child theme folder.

* `functions.php`
..* identifies your child theme for Genesis
..* loads WP-Boilerplate
..* can be used to add custom functionality to your child theme
* `js/theme.js`
..* is used by webpack to manage JS dependencies
..* can be used to add custom functionality to your child theme
* `scss/_variables.scss`
..* is used by webpack to override Bootstrap 4 variables
..* can be used to add custom variables to your child theme
* `scss/theme.scss`
..* is used by webpack to compile custom styles into your child theme

#### Important Notes

* Files in the `boilerplate` directory should not be modified. Everything in boilerplate (PHP, JS, SASS) can be overridden in your child theme.
* Files in the `dist` directory should not be modified directly. Webpack overwrites the `dist` folder every time the project is compiled.
