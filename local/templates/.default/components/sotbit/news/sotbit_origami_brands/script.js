$( document ).ready(function() {


function updateURL(value) {
    if (history.pushState) {
        var baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        var newUrl = baseUrl + '?section='+value;
        history.pushState(null, null, newUrl);
    }
    else {
        console.warn('History API не поддерживается');
    }
}



$('#category_custom').on('change', function() {
 	updateURL(this.value);
 	location.reload();
});

$('.click_change_section').on('click', function() {
 	updateURL($(this).find('input').val());
 	location.reload();
});



});