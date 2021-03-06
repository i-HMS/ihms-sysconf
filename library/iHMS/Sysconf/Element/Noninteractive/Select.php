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
 * @subpackage  Element_Noninteractive
 * @copyright   2012 by iHMS Team
 * @author      Laurent Declercq <l.declercq@nuxwin.com>
 * @version     0.0.1
 * @link        https://github.com/i-HMS/sysconf Sysconf Home Site
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GPL v2
 */

namespace iHMS\Sysconf\Element\Noninteractive;

use iHMS\Sysconf\Element\AbstractNoninteractive;

/**
 * Select class
 *
 * This is a dummy input select element.
 *
 * @category    iHMS
 * @package     iHMS_Sysconf
 * @subpackage  Element_Noninteractive
 * @author      Laurent Declercq <l.declercq@nuxwin.com>
 * @link        https://github.com/i-HMS/sysconf Sysconf Home Site
 * @version     0.0.1
 */
class Select extends AbstractNoninteractive
{
    /**
     * Show
     *
     * This show method does not display anything. However, if the value of the question associated with it is not set,
     * or is not one of the available choices, then it will be set to the first item in the select list. This is for
     * consistency with the behavior of other select elements
     *
     * @return void
     */
    public function show()
    {
        // Make sure the choices list in in the C locale, not localized
        $this->question->getTemplate()->setI18n(false);
        $choices = $this->question->choicesSplit();
        $this->question->getTemplate()->setI18n(true);
        $value = $this->question->getValue();

        if (is_null($value)) {
            $value = '';
        }

        if (!in_array($value, $choices)) {
            if (!empty($choices)) { // TODO check
                $this->_value = $choices[0];
            } else {
                $this->_value = '';
            }
        } else {
            $this->_value = $value;
        }
    }
}
