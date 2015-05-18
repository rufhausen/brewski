$(function () {

$('#datetimepicker1').datetimepicker();

    $('#post-tags').selectize({
        valueField: 'name',
        labelField: 'name',
        searchField: 'name',
        plugins: ['remove_button','restore_on_backspace'],
        delimiter: ',',
        create: true,
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: '/api/tags/' + encodeURIComponent(query),
                type: 'GET',
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data.slice(0, 10));
                }
            });
        }
    });
});