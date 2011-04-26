<aside id="sidebar">
	<?= $SearchForm ?>	
	<section id="blogRoll">
		<header>
			<h2>Blogs &amp; Freunde</h2>
		<header>
		<?php echo $HTML->link('http://fuenf-filmfreunde.de', '5 Filmfreunde', array('rel' => 'external')); ?><br />
		<?php echo $HTML->link('http://leinwandhelden.de', 'Leinwandhelden.de', array('rel' => 'external', 'title' => 'Kino News, Trailer und Bilder')); ?><br />
		<?php echo $HTML->link('http://www.paradiseofhorror.com', 'Paradise of Horror', array('rel' => 'external', 'title' => 'Rick’s Paradise of Horror (englisch)')); ?><br />
		<?php echo $HTML->link('http://www.dravenstales.ch', 'Dravenstales.ch', array('rel' => 'external', 'title' => 'Dravens Tales from the Crypt')); ?><br />
		<?php echo $HTML->link('http://www.moviepilot.de', 'Moviepilot', array('rel' => 'external')); ?><br />
		<?php echo $HTML->link('http://www.lotterliebe.de', 'Lotterliebe', array('rel' => 'external')); ?><br />
		<?php echo $HTML->link('http://www.nerd-wiki.de', 'Nerd-Wiki', array('rel' => 'external', 'title' => 'Fantasy Blog: Nerdity & Philosophy'))?><br />
		<?php echo $HTML->link('http://www.filmherum.de', 'Filmherum', array('rel' => 'external')) ?><br />
		<?php echo $HTML->link('http://www.blackfear.de', 'Blackfear', array('rel' => 'external')) ?><br />
		<?php echo $HTML->link('http://gruselseite.com', 'GruselSeite.com', array('rel' => 'external')); ?><br />
		<?php echo $HTML->link('http://blog.buecher.de', 'Der Bücher Blog', array('rel' => 'external', 'title' => 'Der Bücher Blog – Bestseller, Kritiken, Aktuelles')); ?><br />
		<?php echo $HTML->link('http://www.near-dark.de', 'Near Dark', array('rel' => 'external', 'title' => 'Near-Dark - Filmkritiken, Kinostarts und Gruselfilme')); ?><br />
		<?php echo $HTML->link('http://www.horrorklinik.de', 'Horrorklinik', array('rel' => 'external', 'title' => 'Horrorklinik, Halloweenzubehör, Verkleidungen!')); ?><br />
		<?php echo $HTML->link('http://www.gruselfabrik.de', 'Gruselfabrik', array('rel' => 'external', 'title' => 'Halloween Shop Shopping für Horrorfans')); ?><br />
		<?php echo $HTML->link('http://www.horrorpilot.com', 'Horrorpilot', array('rel' => 'external', 'title' => 'Horrorpilot.com')); ?><br />
		<?php echo $HTML->link('http://www.scary-movies.de/', 'Scary-Movies', array('rel' => 'external', 'title' => 'Horrorfilm News')); ?><br />
		<?php echo $HTML->link('http://hardline.blog.de/', 'Filmreihe HARD:LINE', array('rel' => 'external', 'title' => 'Horrorfilmreihe in Regensburg')); ?><br />
		<?php echo $HTML->link('http://rezension.org/', 'Rezension.org', array('rel' => 'external', 'title' => 'Filmrezensionen mit Fazit')); ?><br />
		<?php echo $HTML->link('http://www.movieworlds.com/', 'Kinofilme', array('rel' => 'external', 'title' => 'Kinofilme, DVD und Blu-ray Neuheite')); ?><br />
		<?php echo $HTML->link('http://filmlandschaft.net/', 'Filmlandschaft.net', array('rel' => 'external', 'title' => 'Filmlandschaft - es geht um Filme')); ?><br />
		<?php echo $HTML->link('http://www.die-besten-horrorfilme.de/', 'die-besten-horrorfilme.de', array('rel' => 'external', 'title' => 'Große Website um Horrorfilme')); ?><br />
		<?php echo $HTML->link('http://intermoviession.de/', 'intermoviession', array('rel' => 'external', 'title' => 'Intermoviesession - Film, Movie &amp; Cinéma')); ?><br />
		<?php echo $HTML->link('http://www.mehrfilm.de/', 'mehrfilm.de', array('rel' => 'external', 'title' => 'mehrfilm.de')); ?><br />
		<div style="display: none">
			<a href="http://www.migrador.de" title="migrador.de: Besondere Reisen. online buchen!">Migrador</a>
			<a href="http://www.peterarold.de/" title="Dachreperatur, Dachdecker und Dachdeckermeister in Werda, Plauen, Hof und im Vogtland">Dachdeckermeister Peter Arold in Werda, Plauen, Hof und Umgebung</a>
			<a href="http://www.la-petite-provence.de/" title="Pension in Leisnig im Muldental">La Petite Provence - Pension und Festsaal in Leisnig</a>
		</div>
	</section>
	<?= $this->view->render('element', 'facebook/likeBox'); ?>
</aside>