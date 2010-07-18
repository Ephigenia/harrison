BEGIN:VCALENDAR
VERSION:2.0
PRODID:PHP/ephFrame <?php echo ephFrame::VERSION.LF; ?>
X-WR-CALNAME:<?php echo AppController::NAME ?>
BEGIN:VTIMEZONE
TZID:/Mozilla.org/BasicTimezones/GMT
LOCATION:GMT
END:VTIMEZONE
<?php echo @$content ?>
END:VCALENDAR