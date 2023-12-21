import './bootstrap';

/*$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $("[name = 'csrf-token]").attr("content")
    },
});*/


$("#search").on("submit", function(event) {
    event.preventDefault();
    
    var formData = $(this).serialize(); 

    $.ajax({
        type: "GET",
        url: "search",
        data: formData,
        dataType: "html",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            var newTable = $(data).find('table.all');
            $("#product-list table.all").html(newTable);
        },
        error: function() {
            alert("読み込み失敗");
        }
    });

});

$('deleteBtn{{$product->id}}').on('post', function() {
    $.ajax({
        type:'DELETE',
        url: '/post.destroy/' + productId,
        data: {'id': productID},
        dataType: 'json',
        success: function (data) {
            $('#deleteForm' + productId).closest('tr').remove();//削除
            alert(response.message);
        },
        error: function (){
            alert('商品の削除に失敗しました');
        }
    });
});

