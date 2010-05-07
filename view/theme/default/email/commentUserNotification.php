Hallo <?php echo $RecipientComment->get('name') ?>!

Du hast am <?php echo date('d.m.Y H:i', $RecipientComment->created) ?> einen Kommentar im Blog von mir hinterlassen.
Gerade eben hat <?php echo $Comment->get('name') ?> darauf geantwortet, schau's Dir an:

<?php echo $BlogEntry->detailPageURL() ?>#comments

Liebe Grüße,
Marcel Eichner