<?php

namespace app\entities;

/**
 * Flags for {@link BlogPost}
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-03-14
 * @package harrison
 * @subpackage harrison.lib.model
 */
class BlogPostFlag
{
	const ALLOW_COMMENTS = 512;	// allow comments on blog posts
	const STICKY = 2048;	// sticky blog posts (always on top)
}