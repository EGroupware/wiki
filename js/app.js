/**
 * EGroupware - Wiki - Javascript UI
 *
 * @link http://www.egroupware.org
 * @package wiki
 * @author Ralf Becker
 * @license https://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 */
import { EgwApp } from "../../api/js/jsapi/egw_app";
/**
 * Javascript for wiki
 *
 * @augments AppJS
 */
class WikiApp extends EgwApp {
    /**
     * Constructor
     *
     * @memberOf app.calendar
     */
    constructor() {
        // call parent
        super("wiki");
        jQuery(document).ready(function () {
            // add target _blank to all external links, as our content security policy will prevent them otherwise
            jQuery('a').click(function () {
                if (this.href.substr(0, 1 + window.location.origin.length) !== window.location.origin + '/') {
                    this.target = '_blank';
                }
            });
        });
    }
    /**
     * Onchange for readable and writable acl: default back to "Everyone" if non set
     *
     * @param {DOMNode} _node
     * @param {et2_select} _widget
     */
    onchange_acl(_node, _widget) {
        const value = _widget.get_value();
        if (jQuery.isArray(value) && !value.length) {
            _widget.set_value(['_0']);
        }
    }
}
app.classes.wiki = WikiApp;
//# sourceMappingURL=app.js.map