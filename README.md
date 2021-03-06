Harrison CMS Readme
==============================================================================
2010-05-08, Marcel Eichner // Ephigenia <love@ephigenia.de>

This is the readme file for the Harrison CMS. It should contain basic
information about setting up a simple Harrison project. If you don’t find what
you need, please check the [official Harrison project website](http://code.marceleichner.de/project/harrison).

# Installation

* Copy everything, including .htaccess file to an empty folder
	* edit the .htaccess files as described in it
* Run `cleanup.sh` to set all directory permissions
* Local Setup
	* modify `html/ephFrame.php` to find [ephFrame PHP Framework](github.com/Ephigenia/ephFrame)
	* modify `.htaccess` files if needed
* Database Setup
	* create new data base and import `config/structure.sql` to create basic
	Harrison tables
	* modify `config/db.php` to have access to the db
	
After this you should be able to call
`http://localhost/[your_installation_path]/admin/` to access the
administration area and can login with `admin@ephigenia.de` and `adminadmin`.

# Where to Start?

You can start by creating your very own template for Harrison by changing the
`$theme` variable of the `AppController` and then create a directory under
`views/theme/[themename]`. In there you can do whatever you want.

Use the Node/Pages Tree for creating static content in multiple languages and
read them with the NodesController and render them with your Node Views. All
files from the `views/node/` directory get listet in the Node-Edit Form.

# Changelog

* 0.4.5
	* Complete Mobile Admin integration for iPhone and Android
	* Rework of some Forms and Callbacks in the default theme, controllers
	and admin
	* All Form Fields in admin get an (optional) if they are not required and
	':' is added via style
	* Default theme is html5 compatible and uses google font api

# Roadmap

* 0.5
	* User Admin extra Form for Password change
	* Password Strength Indicator
	* Complete default Permission Check Data
	* Optional Fields for Nodes and BlogPosts (completely custom)
	* Site-wide configuration via admin not config files (page title, meta tags etc.)
	* workaround for uploaded files with the same name

* 0.6
	* Put Uploaded Files into sub directories
	* Devide Harrison from Application stuff for easier updating
	* Better Multilingual Interface for Node
	* Better Multilingual Interface for MediaFiles
	* Better Forms for Blogs, Node, MediaFiles
	* Slickier Interface for tags (hints, and completion)