<?php
/**
 * Moin
 * @package moin-base
 *
 * @author Rob Frawley <code AT robfrawley DOT com>
 * @license GNU Public License <http://www.gnu.org/licenses/gpl.txt>
 *
 * @version $Id: database.php 167 2007-10-03 20:20:11Z rmf $
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
 * database type
 */
define('DB_TYPE', 'mysqli');

/**
 * database name
 */
define('DB_NAME', 'moin');

/**
 * database hostname
 */
define('DB_HOST', 'localhost');

/**
 * database username
 */
define('DB_USER', 'moin');

/**
 * database password
 */
define('DB_PASS', '');

/**
 * database table prefix
 */
define('DT_PREFIX', 'moin_');
?>