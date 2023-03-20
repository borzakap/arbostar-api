// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            document.body.classList.toggle('sb-sidenav-toggled');
        }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

// priview uploaded image
const photo = document.getElementById('photo');
if (photo) {
    photo.onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('imagepreview').src = src
    }
}
;

// Change the langs
$(document).on('change', '#lang_changer', function (e) {
    var $lang_field = $('.languages-variants');
    var $selected_lang = $(this).val();
    $lang_field.each(function () {
        if ($(this).data('language') !== $selected_lang) {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
    });
});
