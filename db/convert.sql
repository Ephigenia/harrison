DROP VIEW IF EXISTS blog_post_comment;
CREATE VIEW
	blog_post_comment
AS
	SELECT
		id,
		user_id,
		foreign_id as blog_post_id,
		status,
		ip,
		name,
		email,
		url,
		`text`,
		FROM_UNIXTIME(created) as created,
		FROM_UNIXTIME(updated) as updated
	FROM
		horrorblog_comments
	WHERE
		model = 'BlogPost'
;

DROP VIEW IF EXISTS blogpost;
CREATE VIEW
	blogpost
AS
	SELECT
		id,
		flags & 2048 as sticky,
		flags,
		status,
		language_id,
		views,
		user_id,
		uri,
		headline,
		`text`,
		FROM_UNIXTIME(created) as created,
		FROM_UNIXTIME(published) as published,
		FROM_UNIXTIME(updated) as updated
	FROM
		horrorblog_blog_posts
;

DROP VIEW IF EXISTS user;
CREATE VIEW
	user
AS
	SELECT
		id,
		user_group_id,
		flags,
		status,
		locale,
		name,
		email,
		password,
		ip,
		permanent_key,
		FROM_UNIXTIME(created) as created,
		FROM_UNIXTIME(updated) as updated,
		FROM_UNIXTIME(lastlogin) as lastlogin
	FROM
		horrorblog_users
;

DROP VIEW IF EXISTS tag;
CREATE VIEW
	tag
AS
	SELECT
		id, name
	FROM
		horrorblog_tags
;

DROP VIEW IF EXISTS blogpost_tag;
CREATE VIEW
	blogpost_tag
AS
	SELECT
		id,
		tag_id,
		foreign_id as blogpost_id
	FROM
		horrorblog_tags_model
	WHERE
		model = 'BlogPost'
;

DROP VIEW IF EXISTS node;
CREATE VIEW
	node
AS
	SELECT
		node.id,
		node.status,
		node.user_id,
		node.name,
		translation.uri,
		translation.headline,
		translation.text,
		node.template,
		FROM_UNIXTIME(node.created) as created,
		FROM_UNIXTIME(node.updated) as updated,
		FROM_UNIXTIME(node.published) as published
	FROM
		horrorblog_nodes as node
	JOIN
		horrorblog_node_texts translation ON
					node.id = translation.node_id
			AND	translation.language_id = 'de'
;