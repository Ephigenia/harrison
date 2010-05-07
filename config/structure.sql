-- ---------------------------------------------------------------------------
-- structure file for a harrison cms 0.3.3
--
-- this file should be used to create a initial database tables that can be
-- used with nms.update. Example data should be possible as well as
-- descriptions for table fields.
--
-- @author Marcel Eichner // Ephigenia <love@ephigenia.de>
-- ---------------------------------------------------------------------------
-- make sure your database coallation is set to use utf-8, otherwise you need
-- to add charset to every table definition. Please note that this file should
-- be read and saved as utf8 as well.
-- ---------------------------------------------------------------------------


-- ---------------------------------------------------------------------------
-- User’s table, groups and permissions
-- ---------------------------------------------------------------------------
-- users table
DROP TABLE IF EXISTS harrison_users;
CREATE TABLE harrison_users (
	id int(6) unsigned NOT NULL auto_increment,
	user_group_id int(6) unsigned NULL default NULL,	-- group user belongs to
	flags int(6) unsigned NOT NULL default 0,	-- deleted/blocked etc.
	locale varchar(5) NOT NULL,					-- locale id for translations
	name varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	password varchar(32) NOT NULL,				-- password should be md5!
	description TEXT NULL default NULL,
	ip int(11) unsigned NULL default NULL,
	permanent_key varchar(32) NULL default NULL, -- key for permanent cookie
	logins int(11) unsigned NOT NULL default 0,  -- number of logins
	lastlogin int(11) NOT NULL,					 -- timestamp of last login
	created int(11) unsigned NOT NULL,
	updated int(11) unsigned NULL default NULL,
	PRIMARY KEY (id),
	KEY (user_group_id),
	KEY (locale),
	KEY (name),
	KEY (email),
	KEY (permanent_key),
	KEY (flags)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO harrison_users (flags, locale, group_id, name, email, password) VALUES 
	 (16, 'de_DE', 1, 'Marcel Eichner', 'love@ephigenia.de', 'f7060fdb27e08dfbc97c9fa5c8b55365')
;

-- user groups
DROP TABLE IF EXISTS harrison_user_groups;
CREATE TABLE harrison_user_groups (
	id int(6) unsigned NOT NULL auto_increment,
	name varchar(40) NOT NULL default '',
	description TEXT,
	created int(11) unsigned NULL default NULL,
	updated int(11) unsigned NULL default NULL,
	PRIMARY KEY (id),
	KEY name (name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- initial groups
INSERT INTO harrison_groups (id, name) VALUES
	 (1, 'Administratoren')
 	,(2, 'Autoren')
	,(3, 'Benutzer')
;

-- user group rights (rights are assigned to groups)
DROP TABLE IF EXISTS harrison_permissions;
CREATE TABLE harrison_permissions (
	id int(6) unsigned NOT NULL auto_increment,
	name varchar(40),
	rule varchar(128) NOT NULL default '',
	action varchar(60) NOT NULL default '',
	created int(11) unsigned NULL default NULL,
	updated int(11) unsigned NULL default NULL,
	PRIMARY KEY (id),
	KEY (rule)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS harrison_user_groups_permissions;
CREATE TABLE harrison_permissions_groups (
	id int(6) unsigned NOT NULL auto_increment,
	user_group_id int(6) unsigned NOT NULL,
	permission_id int(6) unsigned NOT NULL,
	PRIMARY KEY (id),
	KEY (user_group_id, permission_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ---------------------------------------------------------------------------
-- general tables that are uses for configuration, languages and log
-- ---------------------------------------------------------------------------
-- languages
DROP TABLE IF EXISTS harrison_languages;
CREATE TABLE IF NOT EXISTS harrison_languages (
	id varchar(2) NOT NULL,
	locale varchar(5) NOT NULL,
	status int(6) NOT NULL default 0,
	name varchar(255) NOT NULL default '',
	PRIMARY KEY  (id),
	KEY (status)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO harrison_languages (id, locale, status, name) VALUES
	('de', 'de_DE', 1, 'Deutsch'),
	('en', 'en_EN', 1, 'English')
;


-- -----------------------------------------------------------------------------
-- now plain content, act like pages stuff and their translations
-- -----------------------------------------------------------------------------
-- nodes
DROP TABLE IF EXISTS harrison_nodes;
CREATE TABLE harrison_nodes (
	id int(6) unsigned NOT NULL auto_increment,
	parent_id int(6) unsigned default NULL,
	lft int(6) unsigned NOT NULL default 0,
	rgt int(6) unsigned NOT NULL default 0,
	level int(6) unsigned NOT NULL default 0,
	flags int(6) unsigned NOT NULL default 31,
	status int(6) unsigned NOT NULL default 0,
	user_id int(6) unsigned default NULL,
	name varchar(255) NOT NULL default '',
	template varchar(255) default NULL,
	published int(11) unsigned default NULL,
	created int(11) unsigned default NULL,
	updated int(11) unsigned default NULL,
	PRIMARY KEY (id),
	KEY (user_id),
	KEY (flags),
	KEY (lft),
	KEY (rgt),
	KEY (name),
	KEY (parent_id),
	KEY (published)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `harrison_nodes`
	(id, parent_id, lft, rgt, level, flags, status, user_id, name) VALUES
	(1,  NULL, 1, 2, 0, 32, 1, 1, 'root', NULL, NULL, NULL, NULL);

-- texts for nodes
DROP TABLE IF EXISTS harrison_node_texts;
CREATE TABLE IF NOT EXISTS harrison_node_texts (
	id int(6) unsigned NOT NULL auto_increment,
	node_id int(6) unsigned default NULL,
	language_id varchar(2) NOT NULL,
	user_id int(6) unsigned default NULL,
	revision int(6) unsigned NOT NULL default 0,
	uri varchar(255) NULL default NULL,
	headline varchar(255) NULL default NULL,
	pagetitle varchar(255) NULL default NULL,
	subline varchar(255) NULL default NULL,
	text text NULL default NULL,
	excerpt text NULL default NULL,
	keywords text NULL default NULL,
	created int(11) unsigned default NULL,
	updated int(11) unsigned default NULL,
	PRIMARY KEY (id),
	KEY (node_id),
	KEY (language_id),
	KEY (user_id),
	KEY (uri)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `harrison_node_texts` VALUES(1, 1, 'de', 1, 0, '', 'root', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- blog entries for blog stuff
DROP TABLE IF EXISTS harrison_blog_posts;
CREATE TABLE IF NOT EXISTS harrison_blog_posts (
	id int(6) unsigned NOT NULL auto_increment,
	flags int(6) unsigned NULL default NULL,
	status int(6) unsigned NULL default NULL,
	views int(6) unsigned NULL default 0,
	user_id int(6) unsigned default NULL,
	uri varchar(255) NULL default NULL,
	headline varchar(255) NULL default NULL, 
	text text NULL default NULL,
	tags varchar(255) default NULL,
	published int(11) unsigned default NULL, -- date when blog entry gets published
	created int(11) unsigned default NULL,
	updated int(11) unsigned default NULL,
	PRIMARY KEY (id),
	KEY (user_id),
	KEY (status),
	KEY (flags),
	KEY (uri),
	KEY (published)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- comments
DROP TABLE IF EXISTS harrison_comments;
CREATE TABLE IF NOT EXISTS harrison_comments (
	id int(6) unsigned NOT NULL auto_increment,
	status int(6) unsigned NOT NULL default 0,
	foreign_id int(6) unsigned NOT NULL,
	model varchar(32) NOT NULL,
	user_id int(6) unsigned default NULL,
	ip int(10) unsigned NULL default NULL,
	name varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	url text NULL default NULL,
	text text NULL default NULL,
	created int(11) unsigned default NULL,
	updated int(11) unsigned default NULL,
	PRIMARY KEY (id),
	KEY (ip),
	KEY (user_id),
	KEY (status),
	KEY (model),
	KEY (foreign_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- tags
DROP TABLE IF EXISTS harrison_tags;
CREATE TABLE IF NOT EXISTS harrison_tags (
	id int(6) unsigned NOT NULL auto_increment,
	name varchar(60) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY (name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS harrison_tags_model;
CREATE TABLE IF NOT EXISTS harrison_tags_model (
	id int(6) unsigned NOT NULL auto_increment,
	tag_id int(6) unsigned NOT NULL,
	foreign_id int(6) unsigned NOT NULL,
	model varchar(30) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY (model, tag_id, foreign_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------------
-- now structure for media files, folders and descriptions for them
-- ---------------------------------------------------------------------------

-- media files
DROP TABLE IF EXISTS harrison_media_files;
CREATE TABLE IF NOT EXISTS harrison_media_files (
	id int(6) unsigned NOT NULL auto_increment,
	unique_id varchar(8) NOT NULL,
	folder_id int(6) unsigned NULL default NULL,
	node_id int(6) unsigned NULL default NULL,
	user_id int(6) unsigned NULL default NULL,
	use_model varchar(50) NOT NULL default '',
	flags int(6) unsigned NOT NULL default 1,
	filename varchar(255) NULL default NULL,
	source_url varchar(255) NULL default NULL, -- source url for youtube files f.e.
	url varchar(255) NULL default NULL,
	filesize INTEGER(8) NOT NULL default 0,
	mime_type varchar(36) NULL default NULL,
	width int(4) unsigned NOT NULL default 0,
	height int(4) unsigned NOT NULL default 0,
	downloads int(6) unsigned NOT NULL default 0,
	views int(6) unsigned NOT NULL default 0,
	position int(6) unsigned NOT NULL default 0,
	created int(11) unsigned default NULL,
	updated int(11) unsigned default NULL,
	PRIMARY KEY  (id),
	KEY (unique_id),
	KEY (folder_id),
	KEY (node_id),
	KEY (user_id),
	KEY (use_model),
	KEY (flags)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- folders for media files
DROP TABLE IF EXISTS harrison_folders;
CREATE TABLE IF NOT EXISTS harrison_folders (
	id int(6) unsigned NOT NULL auto_increment,
	parent_id int(6) unsigned NULL default NULL,
	lft int(6) unsigned NOT NULL default 0,
	rgt int(6) unsigned NOT NULL default 0,
	level int(6) unsigned NOT NULL default 0,
	flags int(6) unsigned NOT NULL default 0,
	name varchar(60) NOT NULL,
	uri varchar(60) NOT NULL,
	content_order tinyint(3) NOT NULL default 0,
	created int(11) unsigned default NULL,
	updated int(11) unsigned default NULL,
	PRIMARY KEY (id),
	KEY (parent_id),
	KEY (lft),
	KEY (rgt),
	KEY (level),
	KEY (flags)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- initial data for folders
INSERT INTO harrison_folders (id, lft, rgt, level, name) VALUES (id, 1, 2, 0, 'root');

-- media texts
DROP TABLE IF EXISTS harrison_media_texts;
CREATE TABLE IF NOT EXISTS harrison_media_texts (
	id int(6) unsigned NOT NULL auto_increment,
	media_file_id int(6) unsigned NULL default NULL,
	user_id int(6) unsigned NULL default NULL,
	language_id varchar(2) NOT NULL,
	revision int(6) unsigned NOT NULL default 0,
	title varchar(255) NULL default NULL,
	text text NULL default NULL,
	created int(11) unsigned default NULL,
	updated int(11) unsigned default NULL,
	PRIMARY KEY (id),
	KEY (media_file_id),
	KEY (user_id),
	KEY (language_id),
	KEY (revision)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- log
DROP TABLE IF EXISTS harrison_log_entries;
CREATE TABLE harrison_log_entries (
	id int(6) unsigned NOT NULL auto_increment,
	user_id int(6) unsigned NOT NULL,
	node_id int(6) unsigned NULL default NULL,
	blog_post_id int(6) unsigned NULL default NULL,
	comment_id int(6) unsigned NULL default NULL,
	media_file_id int(6) unsigned NULL default NULL,
	folder_id int(6) unsigned NULL default NULL,
	controller varchar(255) NOT NULL default '',
	action varchar(255) NOT NULL default '',
	created int(11) unsigned NULL default NULL,
	PRIMARY KEY (id),
	KEY (user_id),
	KEY (node_id),
	KEY (blog_post_id),
	KEY (comment_id),
	KEY (media_file_id),
	KEY (folder_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;