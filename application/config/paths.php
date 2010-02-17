<?php
/**
 * Moin
 * @package moin
 *
 * @author Rob Frawley <code AT robfrawley DOT com>
 * @license GNU Public License <http://www.gnu.org/licenses/gpl.txt>
 *
 * @version $Id: paths.php 167 2007-10-03 20:20:11Z rmf $
 */

/**#@+
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; only version 2
 * of the License.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/**
 * general php exexutable extension
 */
define('FILE_EXT_EXEC', '.php');

/**
 * library php extension
 */
define('FILE_EXT_LIBRARY', '.phpm');

/**
 * template php extension
 */
define('FILE_EXT_TPL', '.ptpl');

/**
 * system directory separator
 */
define('DIR_SEP', DIRECTORY_SEPARATOR);

/**
 * root directory
 */
define('DIR_BASE', DIR_SEP . 'www' . DIR_SEP . 'creativeartsguide.com' . DIR_SEP);

/**
 * application directory
 */
define('DIR_APPLICATION', DIR_BASE . 'application' . DIR_SEP);

/**
 * variable/temporary folder
 */
define('DIR_DATA', DIR_APPLICATION . 'data' . DIR_SEP);

/**
 * twitter data cache dir
 */
define('DIR_CACHE', DIR_DATA . 'cache' . DIR_SEP);

/**
 * configuration folder
 */
define('DIR_CONFIG', DIR_APPLICATION . 'config' . DIR_SEP);

/**
 * controllers folder
 */
define('DIR_CONTROLLER', DIR_APPLICATION . 'controllers' . DIR_SEP);

/**
 * views folder
 */
define('DIR_VIEWS', DIR_APPLICATION . 'views' . DIR_SEP);

/**
 * internal views folder
 */
define('DIR_VIEWS_FORM', DIR_VIEWS . '_form' . DIR_SEP);

/**
 * web data directory
 */
define('DIR_DATA', DIR_BASE . 'data' . DIR_SEP);

/**
 *  library folder
 */
define('DIR_LIBRARY', DIR_BASE . 'library' . DIR_SEP);

/**
 * class library folder
 */
define('DIR_CLASSES', DIR_LIBRARY . 'classes' . DIR_SEP);

/**
 * function library folder
 */
define('DIR_FUNCTIONS', DIR_LIBRARY . 'functions' . DIR_SEP);

/**
 * public html folder
 */
define('DIR_PUBLIC_HTML', DIR_BASE . 'htdocs' . DIR_SEP);

/**
 * web directory seperator
 */
define('WEB_SEP', '/');

/**
 * web root path
 */
define('WEB_BASE', WEB_SEP);

/**
 * web image path
 */
define('WEB_IMAGES', WEB_BASE . 'images' . WEB_SEP);

/**
 * web style path
 */
define('WEB_STYLES', WEB_BASE . 'styles' . WEB_SEP);
?>
