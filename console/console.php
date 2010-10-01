<?php

/**
 * This file loads console tasks by it’s name, call it from the application
 * root directory like this:
 *
 * $ php console/console.php cronReportEmail 
 * 
 * @since 2009-09-28
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @package app
 * @subpackage app.console
 */

// load ephFrame Framework
define('APP_ROOT', realpath(dirname(__FILE__).'/../').'/');

require (dirname(__FILE__).'/../html/ephFrame.php');
Library::load('ephFrame.lib.console.ConsoleController');

chdir(APP_ROOT.'html/');
require (dirname(__FILE__)).'/AppConsole.php';
new AppConsoleController();