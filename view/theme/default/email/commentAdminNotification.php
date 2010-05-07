<?php echo $Comment->get('name') ?> hat gerade einen Kommentar auf
<?php echo AppController::NAME ?> hinterlassen.

---------------------------------------------------------------------------
<?php echo $Comment->text.LF ?>
---------------------------------------------------------------------------

Sie können den Kommentar direkt anschauen:
<?php echo $BlogPost->detailPageURL() ?>
