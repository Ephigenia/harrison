<!-- reinvigorate -->
<script type="text/javascript" src="http://include.reinvigorate.net/re_.js"></script>
<script type="text/javascript">
try {
	<?php
	if (!empty($Me) && $Me instanceof User) {
		$username = $Me->get('name');
	}
	if (!empty($username)) {
		printf('var re_name_tag = "%s";'.LF, $username);
	}
	?>
	re_("<?php echo $id; ?>")
} catch(err) {}
</script>