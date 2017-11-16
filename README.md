# Webpack Boilerplate


## Getting Started

Welcome to the Webpack Boilerplate. 

### Useful Info about version control (Git & Bitbucket)

Coming Soon

### Useful Info about Wordpress

Coming Soon

### Useful Info about Genesis

Coming Soon

### Webpack Install and Run

You will need to have a copy of node.js installed and updated.
https://nodejs.org/en/

This project uses webpack for its installation. 
https://webpack.js.org/guides/installation/

### Installing Webpack

General steps for installing webpack. Refer to documentation (linked above) for more details.

Using terminal, cd into the child theme folder. 

```
cd wp-content/themes/<child-theme-folder>/boilerplate
```

You should see a file called ```webpack.config.js```. This is the main configuration file for webpack. 

Install the latest release of webpack:

```
npm install --save-dev webpack
```

Resolve any errors with the installation by referring to webpack documentation

In order to build out files in /dist folder, run the following command:

```
npm start
```

Running ```npm start``` will build the files, but will not continue to watch for changes. If you are making changes to the source files, you will probably want to run the following, which will watch for  changes made, and update the /dist file.

```
npm run watch
```

#### Important Note when running webpack
You may see files in the /dist folder to begin with, but these files are over-written each time Webpack is run. DO NOT write your code in the files within the /dist folder as IT WILL BE OVERWRITTEN when webpack is run. 



