/**
 * Created by joaopedrodslv@gmail.com on 24/07/2016.
 */

module.exports = function(el) {
    let ev = document.createEvent("MouseEvent");
    ev.initMouseEvent(
        "click",
        true ,
        window, null,
        0, 0, 0, 0,
        false, false, false, false,
        0, null
    )
    el.dispatchEvent(ev);
}