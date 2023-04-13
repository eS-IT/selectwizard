'use strict';

/**
 * @package     selectwizard
 * @since       15.02.20 - 21:32
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2020
 * @license     LGPL-3.0-only
 */
window.addEventListener("load", function(event) {
    let elements = document.getElementsByClassName('tl_selectmenuwizard');

    for (let elem of elements) {
        let id = elem.id;
        Backend.listWizard(id);
    }
});