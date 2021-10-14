require('./bootstrap');

document.querySelector("label[for='checkbox']").onclick = function(e) {
    let el = e.target.parentElement.querySelector('input');
    el.checked = ! el.checked;
};
