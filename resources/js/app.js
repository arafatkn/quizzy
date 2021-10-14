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
    /*$(".nav-link").each(function(){
        if( $(this).attr('href') == location.href ||
            $(this).attr('href') == location.href.split('?')[0] ||
            $(this).attr('href') == location.pathname ||
            $(this).attr('href') == location.pathname.split('?')[0]
        ) {
            console.log("Found");
            $(this).addClass("active");
            let ul = $(this).parent().parent();
            if(ul.hasClass('nav-treeview')) {
                ul.show();
                ul.parent().addClass("menu-open");
            }
        }
    });*/
});


/*function formFill(dom, data)
{
    dom.find('input,select,textarea').each(function(i){
        if( $(this).attr('name') in data )
            $(this).val( data[$(this).attr('name')] );
    });
}*/
