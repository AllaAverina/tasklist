const select = document.getElementById('sortingList');

document.addEventListener('DOMContentLoaded', function() {
    let params = new URLSearchParams(location.search);

    if (params.has('sort')) {
        select.value = '?' + params;
    } else {
        select.value = select.options[0].value;
    }
});

select.addEventListener('change', function() {
    location = select.value;
});