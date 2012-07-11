<?php
/**
 * Sysconf - Interactive configuration system for PHP applications
 * Copyright (C) 2012 by iHMS Team
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @category    iHMS
 * @package     iHMS_Sysconf
 * @subpackage  Getopt
 * @copyright   2012 by iHMS Team
 * @author      Laurent Declercq <l.declercq@nuxwin.com>
 * @version     0.0.1
 * @link        http://www.i-mscp.net i-MSCP Home Site
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GPL v2
 */

/** @See Zend_Console_Getopt */
require_once 'Zend/Console/Getopt.php';

/**
 * iHMS_Sysconf_Getopt class
 *
 * @category    iHMS
 * @package     iHMS_Sysconf
 * @subpackage  Getopt
 * @author      Laurent Declercq <l.declercq@nuxwin.com>
 * @version     0.0.1
 */
class iHMS_Sysconf_Getopt extends Zend_Console_Getopt
{
    /**
     * Return a useful option reference, formatted for display in an error message.
     *
     * Note that this usage information is provided in most Exceptions generated by this class.
     *
     * @return string Usage message
     */
    public function getUsageMessage()
    {
        $usage = ''; // General usage message must be provided by programm (See iHMS_Sysconf_Config::getopt())
        $maxLen = 20;
        $lines = array();

        foreach ($this->_rules as $rule) {
            $flags = array();
            if (is_array($rule['alias'])) {
                foreach ($rule['alias'] as $flag) {
                    $flags[] = (strlen($flag) == 1 ? '-' : '--') . $flag;
                }
            }

            $linepart['name'] = implode('|', $flags);

            if (isset($rule['param']) && $rule['param'] != 'none') {
                $linepart['name'] .= ' ';
                switch ($rule['param']) {
                    case 'optional':
                        $linepart['name'] .= "[ <{$rule['paramType']}> ]";
                        break;
                    case 'required':
                        $linepart['name'] .= "<{$rule['paramType']}>";
                        break;
                }
            }

            if (strlen($linepart['name']) > $maxLen) {
                $maxLen = strlen($linepart['name']);
            }

            $linepart['help'] = '';

            if (isset($rule['help'])) {
                $linepart['help'] .= $rule['help'];
            }
            $lines[] = $linepart;
        }

        foreach ($lines as $linepart) {
            $usage .= sprintf("%s %s\n",
                str_pad($linepart['name'], $maxLen),
                $linepart['help']);
        }

        return $usage;
    }
}
