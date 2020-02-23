'use strict';

/**
 * @author      pfroch <info@easySolutionsIT.de>
 * @copyright   e@sy Solutions IT 2020
 * @filesource  ListInitializer.js
 * @license     LGPLv3
 * @package     selectwizard
 * @version     1.0.0
 * @since       15.02.20 - 18:07
 */
window.addEventListener("load", function(event) {
    let elements = document.getElementsByClassName('tl_selectmenuwizard');

    for (let elem of elements) {
        let id = elem.id;
        Backend.listWizard(id);
    }
});