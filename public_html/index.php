<?php
/**
 * Moin
 * @package moin-base
 *
 * @author Rob Frawley <code AT robfrawley DOT com>
 * @license GNU Public License <http://www.gnu.org/licenses/gpl.txt>
 *
 * @version $Id: index.php 168 2007-10-07 03:01:46Z rmf $
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

/* very basic session management at this point */
session_start();

/* get the start time of the php script execution */
define('SCRIPT_START', microtime(true));

/* include paths config file */
include '../application/config/paths.php';

/* include general config file */
include DIR_CONFIG . 'general.live.php';

/* include database config file */
include DIR_CONFIG . 'database.live.php';

/* include api auth config file */
include DIR_CONFIG . 'api_auths.live.php';

/* include functions file */
include DIR_FUNCTIONS . 'general.php';


/* set error reporting */
error_reporting(SYSTEM_ERRORLEVEL);

/* set default timezone */
date_default_timezone_set(SYSTEM_TIMEZONE);

try
{
  /* instantiate disbatcher class */
  $Dispatcher = new Dispatcher();
  /* perform functions and render page */
  $Dispatcher->run();
}
catch(ExceptionAbstract $ExceptionAbstract)
{
  /* display error message for thrown exception */
  $ExceptionAbstract->triggerEvent();
}
?>
