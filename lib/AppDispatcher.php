<?php

/**
 * ephFrame: <http://code.marceleichner.de/project/ephFrame/>
 * Copyright 2007+, Ephigenia M. Eichner, Kopernikusstr. 8, 10245 Berlin
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright Copyright 2007+, Ephigenia M. Eichner
 * @link http://code.marceleichner.de/projects/ephFrame/
 * @filesource
 */

/**
 * Parent class for App's Dispatcher
 * 
 * This class extends the ephFrame {@link Dispatcher}. You can override methods
 * of the native Dispatcher if you need to. Possible aims are the router-controller
 * connection created in the {@link dispatch} method.
 * 
 * @package app
 * @subpackage app.lib
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de
 * @since 16.12.2007
 */
class AppDispatcher extends Dispatcher { }