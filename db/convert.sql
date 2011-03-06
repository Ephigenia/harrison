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

CREATE VIEW
	blogpost
AS
	SELECT
		id,
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