


$("#thumbnails a").on('click', function(e) {
    e.preventDefault();

    $('#big').attr('src', $(this).attr('href'));
});