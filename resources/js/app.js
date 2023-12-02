import './bootstrap';

$("#search"). on("submit", function() {
    $.ajax({
        type: 'GET',
        url: "{{ route('search') }}",
        dataType: "json",
        success: function(response) {

        }
    })
})


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

$(function() {
    $.ajax({
        type: 'POST',
        url: '/post.destroy/' + productId, 
        dataType: "json",
        success: function(response) {
            
        }
    })
})