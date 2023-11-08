import './bootstrap';

$("#search"). on("submit", function() {
    $.ajax({
        type: 'GET',
        url: "{{ route('search') }}",
        data: "json",
        success: function(responce) {

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
        data: "json",
        success: function(responce) {
            
        }
    })
})