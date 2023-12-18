import './bootstrap';

/*$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $("[name = 'cserf-token]").attr("content")
    },
});*/


$("#search").on('submit', function(event) {
    event.preventDefault();


    $.ajax({
        type: "GET",
        url: "{{ route('search') }}",
        data: formData,
        dataType: 'html',
        success: function(data) {
            $('#product-list').html(data);//一覧画面の表示
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

