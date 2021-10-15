require('./bootstrap');

import {gdConfirm, getDataById, slugify} from "./custom";

const checkbox = document.querySelector("label[for='checkbox']");

if(checkbox) {
    checkbox.onclick = function(e) {
        let el = e.target.parentElement.querySelector('input');
        el.checked = ! el.checked;
    };
}

document.addEventListener("DOMContentLoaded", function(event) {
    // Your code to run since DOM is loaded and ready
    document.querySelectorAll(".nav-link").forEach(function(el) {
        if( el.href === location.href ||
            el.href === location.href.split('?')[0] ||
            el.href === location.pathname ||
            el.href === location.pathname.split('?')[0]
        ) {
            console.log("Found");
            //el.parentElement.classList.add("active");
            //el.parentElement.style.backgroundColor = "#6699ff";
        }
    });
});


function formFill(dom, data)
{
    dom.querySelectorAll('input,select,textarea').forEach(function(el){
        if( el.name in data )
            el.value = data[ el.name ];
    });
}
