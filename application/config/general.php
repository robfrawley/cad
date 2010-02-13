<?php
/**
 * Moin
 * @package moin-base
 *
 * @author Rob Frawley <code AT robfrawley DOT com>
 * @license GNU Public License <http://www.gnu.org/licenses/gpl.txt>
 *
 * @version $Id: general.php 168 2007-10-07 03:01:46Z rmf $
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
 * runtime errorlevel
 */
define('SYSTEM_ERRORLEVEL', E_ALL | E_STRICT);

/**
 * logging enabled
 */
define('LOGGING_ENABLED', false);

/**
 * runtime timezone
 */
define('SYSTEM_TIMEZONE', 'EST');

/**
 * controller name prefix
 */
define('ROUTER_PREFIX_CONTROLLER', 'Controller');

/**
 * controller action name prefix
 */
define('ROUTER_PREFIX_ACTION', 'action');

/**
 * for those who cannot use modrewrite
 */
define('ROUTER_INDEX_FILENAME', '');

/**
 * base controller name
 */
define('ROUTER_BASE_CONTROLLER', 'Base');

/**
 * default controller to instantiate
 */
define('ROUTER_DEFAULT_CONTROLLER', 'default');

/**
 * default controller action to run
 */
define('ROUTER_DEFAULT_ACTION', 'default');

/**
 * router header filename
 */
define('ROUTER_FILE_HEADER', '_header');

/**
 * router body filename
 */
define('ROUTER_FILE_BODY', 'body');

/**
 * router footer filename
 */
define('ROUTER_FILE_FOOTER', '_footer');

/**
 * enable and disable system cache
 */
define('SYSTEM_CACHE', false);

/**
 * time to cache
 */
define('SYSTEM_CACHE_TIME', 3600);

/**
 * display system time
 */
define('SYSTEM_TIME', false);
?>
