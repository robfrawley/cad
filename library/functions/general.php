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
 * magic autoloader function for classes
 * @param string $class_name
 */
function __autoload($class_name)
{
  $matches = array();
  preg_match("/[A-Z][a-z]*/", $class_name, $matches);
  if(is_array($matches) === false || sizeof($matches) > 0)
  {
    $class_directory = $matches[0] . DIR_SEP;
  }
  else
  {
    $class_directory = '';
  }
  $class_path = DIR_CLASSES . $class_directory . $class_name . FILE_EXT_LIBRARY;
  if((include_once $class_path) === false)
  {
    echo __FILE__ . "\n";
    echo getcwd() . "\n";
    die('Could not include required class path ' . $class_path . '.' . "\n\n");
  }
  if((class_exists($class_name) === false) && (interface_exists($class_name) === false))
  {
    die('Included file ' . $class_path . ' does not contain a declaration for required class ' . $class_name . '.');
  }
}
?>