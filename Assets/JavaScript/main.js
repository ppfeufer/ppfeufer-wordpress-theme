/*
 * Copyright (C) 2019 ppfeufer
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/* Stuff without jQuery
 ----------------------------------------------------------------------------- */
/**
 * Detecting JS Support
 *
 * @param {type} body
 * @returns {undefined}
 */
(function(body) {
    body.className = body.className.replace(/\bno-js\b/, 'js');
})(document.body);

/**
 * Detecting mobile devices
 *
 * @returns {boolean} true/false
 */
function isMobile() {
    return navigator.userAgent.match(/(iPhone|iPod|iPad|blackberry|android|Kindle|htc|lg|midp|mmp|mobile|nokia|opera mini|palm|pocket|psp|sgh|smartphone|symbian|treo mini|Playstation Portable|SonyEricsson|Samsung|MobileExplorer|PalmSource|Benq|Windows Phone|Windows Mobile|IEMobile|Windows CE|Nintendo Wii)/i);
}

/* Stuff that needs jQuery
 ----------------------------------------------------------------------------- */
jQuery(function($) {

});
