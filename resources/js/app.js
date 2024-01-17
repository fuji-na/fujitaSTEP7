import './bootstrap';


$("#search").on("submit", function (event) {
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
        success: function (data) {
            console.log(data);
            var newTableBody = $(data).find('table.all tbody');
            $("#product-list table.all tbody").html(newTableBody.html());

            // ソートが有効になるようにsortableを適用
            applySortable();
        },
        error: function () {
            alert("読み込み失敗");
        }
    });
});

// ソートが有効になるように再度sortableを適用
function applySortable() {
    // @sortablelinkを再度有効にする
    $(".sortable-column ").on("click", function (event) {
        event.preventDefault();
        var href = $(this).attr('href');
        sortTable(href);
    });
}

// テーブルをソートする関数
function sortTable(href) {
    $.ajax({
        type: "GET",
        url: href,
        dataType: "html",
        success: function (data) {
            console.log(data);
            var newTableBody = $(data).find('table.all tbody');
            $("#product-list table.all tbody").html(newTableBody.html());
            applySortable(); // ソートを有効にする
        },
        error: function () {
            alert("ソート失敗");
        }
    });
}

// ページロード時にsortableを初期化
applySortable();



//http://localhost:8888/FujitaSTEP7/public/ichiran

// 関数を作成
function deleteProduct(productId) {
    $.ajax({
        type: "POST",
        url: "post.destroy/" + productId,
        data: {'id': productId, '_method': 'DELETE'},
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            console.log(data.message);
            $("#deleteForm" + productId).closest('tr').remove(); // 削除
            alert('完了');
        },
        error: function () {
            alert('商品の削除に失敗しました');
        }
    });
}

// 削除ボタンのクリックイベントハンドラを設定する関数
function setDeleteButtonEventHandler() {
    $(".delete").on("click", function (event) {
        event.preventDefault();
        var productId = $(this).attr('id').replace('deleteBtn', '');

        // 関数呼び出し
        deleteProduct(productId);
    });
}

// クリックイベントのハンドラを設定
$(".delete").on("click", function (event) {
    event.preventDefault();
    var productId = $(this).attr('id').replace('deleteBtn', '');

    // 関数呼び出し
    deleteProduct(productId);
});

