import './bootstrap';


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
            console.log(data)
            var newTableBody = $(data).find('table.all tbody');
            $("#product-list table.all tbody").html(newTableBody.html());
        },
        error: function() {
            alert("読み込み失敗");
        }
    });

});
//http://localhost:8888/FujitaSTEP7/public/ichiran

$('deleteBtn{{$product->id}}').on('click', function() {

    var productId = $(this).attr('id').replace('deleteBtn', '');

    $.ajax({
        type:'DELETE',
        url: '/post.destroy/{id}',
        data: {'id': productID},
        dataType: 'json',
        success: function (data) {
            $('#deleteForm' + productId).closest('tr').remove();//削除
            alert(data.message);
        },
        error: function (){
            alert('商品の削除に失敗しました');
        }
    });
});

