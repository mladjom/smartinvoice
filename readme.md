# SmartInvoice

Invoicing application built with Laravel 4.2.6 and Bootstrap 3.2.0

## Table of contents

 - [Requirements](#requirements)
 - [Installation](#installation)
 - [Copyright and license](#license)

##Requirements

	PHP >= 5.4.0
	MCrypt PHP Extension

##  Installation

### Step 1: Get the code

#### Option 1: Git Clone

git clone https://github.com/mladjom/smartinvoice.git

#### Option 2: Download the repository

 https://github.com/mladjom/smartinvoice/archive/master.zip

### Step 2: Use Composer to install dependencies

    cd smartinvoice
    composer install

- [Composer Introduction](https://getcomposer.org/doc/00-intro.md)

### Step 3: Configure Environments

### Step 4: Configure Database

### Step 5: Configure Mailer

### Step 6: Populate Database

Run these commands to create and populate Users table:

	php artisan migrate
	php artisan db:seed

### Step 8: Make sure app/storage is writable by your web server.

If permissions are set correctly:

    chmod -R 775 app/storage

Should work, if not try

    chmod -R 777 app/storage

### Step 9: Assets management 

SmartInvoice uses node, bower and grunt to manage assets.

Run these commands

    npm install
    bower install
    grunt

- Unfamiliar with `npm`? Don't have node installed? That's a-okay. npm stands for [node packaged modules](http://npmjs.org/) and is a way to manage development dependencies through node.js. [Download and install node.js](http://nodejs.org/download/) before proceeding.
- Install [Bower](http://bower.io): `npm install -g bower`.
- [Install Grunt](http://gruntjs.com/getting-started) globally.

##### Build - `grunt` 
Run `grunt` to run all tasks locally and copy and compile the CSS and JavaScript into `/assets`. **Uses [Copy] (https://github.com/gruntjs/grunt-contrib-copy), [Less](http://lesscss.org/) and [UglifyJS](http://lisperator.net/uglifyjs/).**

### License

SmartInvoice is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT)
