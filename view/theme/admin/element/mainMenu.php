<?php $CSS->link($elementBaseName); ?>
<div id="leftColumn">
	<ul id="mainMenu">
		
		<li class="minimize"><a href="javascript:void(0);">« minimize</a></li>
		
		<!-- Page / Node / Article Administration -->
		<li<?php if ($controller == 'Node') echo ' class="selected"'; ?>>
			<a href="javascript:void(0);" class="toggle">+</a>
			<?php echo $HTML->link(Router::getRoute('adminNode'), __('Seiten')) ?>
			<ul>
				<li<?php echo in_array($controller.$action, array('Nodeindex', 'Nodeedit')) ? ' class="selected"' : ''; ?>>
					<?php echo $HTML->link(Router::getRoute('adminNode'), __('Bearbeiten/Verschieben')) ?>
				</li>
				<li<?php echo $controller.$action == 'Nodecreate' ? ' class="selected"' : ''; ?>>
					<?php echo $HTML->link(Router::getRoute('adminNodeCreate', array('action' => 'create')), __('Neue Seite erstellen')) ?>
				</li>
			</ul>
		</li>
		
		<!-- Blog Posts Administration -->
		<li<?php if ($controller == 'BlogPost') echo ' class="selected"'; ?>>
			<a href="javascript:void(0);" class="toggle">+</a>
			<?php echo $HTML->link(Router::getRoute('adminBlogPost'), __('Blog')) ?>
			<ul>
				<li<?php echo in_array($controller.$action, array('BlogPostindex', 'BlogPostedit')) ? ' class="selected"' : ''; ?>>
					<?php echo $HTML->link(Router::getRoute('adminBlogPost'), __('Blogeinträge')); ?>
				</li>
				<li<?php echo $controller.$action == 'BlogPostcreate' ? ' class="selected"' : ''; ?>>
					<?php echo $HTML->link(Router::getRoute('adminBlogPostCreate', array('action' => 'create')), __('Neuer Blogeintrag')); ?>
				</li>
			</ul>
		</li>
		
		<!-- File Administration -->
		<li<?php if ($controller == 'MediaFile' || $controller == 'Folder') echo ' class="selected"'; ?>>
			<a href="javascript:void(0);" class="toggle">+</a>
			<?php echo $HTML->link(Router::getRoute('adminMediaFiles'), __('Dateien & Bilder')) ?>
			<ul>
				<li<?php echo $controller.$action == 'Folderview' ? ' class="selected"' : ''; ?>><?php echo $HTML->link(Router::getRoute('adminMediaFiles'), __('Dateien & Bilder')); ?></li>
				<li<?php echo $controller.$action == 'Foldercreate' ? ' class="selected"' : ''; ?>><?php echo $HTML->link(Router::getRoute('adminFolderCreate'), __('Neue Kategorie')); ?></li>
				<li<?php echo $controller.$action == 'MediaFileupload' ? ' class="selected"' : ''; ?>><?php echo $HTML->link(Router::getRoute('adminMediaUpload'), __('Datei hochladen')); ?></li>
			</ul>
		</li>
		
		<!--  Comment Administration -->
		<li<?php if ($controller == 'Comment') echo ' class="selected"'; ?>>
			<?php echo $HTML->link(Router::getRoute('adminComment'), __('Kommentare')) ?>
		</li>

		<!-- User Configuration -->
		<li<?php if ($controller == 'User') echo ' class="selected"'; ?>>
			<a href="javascript:void(0);" class="toggle">+</a>
			<?php echo $HTML->link(Router::getRoute('adminUser'), __('Benutzer')) ?>
			<ul>
				<li<?php echo $controller.$action == 'Userindex' ? ' class="selected"' : ''; ?>>
					<?php echo $HTML->link(Router::getRoute('adminUser'), __('Benutzerliste')) ?>
				</li>
				<li<?php echo $controller.$action == 'Usercreate' ? ' class="selected"' : ''; ?>>
					<?php echo $HTML->link(Router::getRoute('adminUserAction', array('action' => 'create')), __('Benutzer erstellen')) ?>
				</li>
				<?php if (isset($Me)) { ?>
					<li<?php echo (isset($User) && $User->id == $Me->id) ? ' class="selected"' : ''; ?>><?php echo $HTML->link($Me->adminDetailPageUri(), __('Mein Profil')) ?></li>
				<?php } ?>
			</ul>
		</li>
		
		<!-- configuration -->
		<li<?php if (in_array($controller, array('UserGroup', 'Language'))) echo ' class="selected"'; ?>>
			<a href="javascript:void(0);" class="toggle">+</a>
			<?php echo $HTML->link(Router::getRoute('adminScaffold', array('controller' => 'UserGroup')), __('Einstellungen')) ?>
			<ul>
				<li<?php echo $controller == 'UserGroup' ? ' class="selected"' : ''; ?>>
					<?php echo $HTML->link(Router::getRoute('adminScaffold', array('controller' => 'UserGroup')), __('Gruppen & Rechte')); ?>
				</li>
				<li<?php echo $controller == 'Language' ? ' class="selected"' : ''; ?>>
					<?php echo $HTML->link(Router::getRoute('adminLanguage'), __('Sprachen')) ?>
				</li>
			</ul>
		</li>
		
	</ul>	
</div>