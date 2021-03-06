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
 * @subpackage  DbDriver
 * @copyright   2012 by iHMS Team
 * @author      Laurent Declercq <l.declercq@nuxwin.com>
 * @version     0.0.1
 * @link        https://github.com/i-HMS/sysconf Sysconf Home Site
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GPL v2
 */

namespace iHMS\Sysconf\DbDriver;

use iHMS\Sysconf\DbDriver;
use iHMS\Sysconf\Log;
use iHMS\Sysconf\Template;

/**
 * Copy class
 *
 * Base driver for of other classes that need to be able to copy entire database items around.
 *
 * @category    iHMS
 * @package     iHMS_Sysconf
 * @subpackage  DbDriver
 * @author      Laurent Declercq <l.declercq@nuxwin.com>
 * @link        https://github.com/i-HMS/sysconf Sysconf Home Site
 * @version     0.0.1
 */
abstract class Copy extends DbDriver
{
    /**
     * Copies the given item from the source database to the destination database
     *
     * The item is assumed to not already exist in dest
     *
     * @param string $itemName Item name to copy
     * @param DbDriver $src Source database
     * @param DbDriver $dest Destination database
     * @reutrn void
     */
    public function copy($itemName, $src, $dest)
    {
        Log::debug("db {$this->_name}", "copying {$itemName} from {$src->_name} to {$dest->_name}");

        $owners = $src->getOwners($itemName);

        if (is_null($owners)) {
            $owners[] = 'unknown';
        }

        # First copy the owners, which makes sure $dest has the item
        foreach ($owners as $owner) {
            $template = Template::get($src->getField($itemName, 'template'));
            $type = '';

            if (!is_null($template)) {
                $type = $template->type;
            }

            $dest->addOwner($itemName, $owner, $type);
        }

        // Now the fields
        foreach ($src->getFields($itemName) as $field) {
            $dest->setField($itemName, $field, $src->getField($itemName, $field));
        }

        // Now the flags
        foreach ($src->getFlags($itemName) as $flag) {
            $dest->setFlag($itemName, $flag, $src->getFlag($itemName, $flag));
        }

        // And finally the variables
        foreach ($src->getVariables($itemName) as $variable) {
            $dest->setVariable($itemName, $variable, $src->getFlag($itemName, $variable));
        }
    }
}
