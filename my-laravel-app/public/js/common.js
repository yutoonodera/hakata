$(function () {

    $('.btn_del').click(function () {
        if (!confirm('削除してもよろしいですか？')) {
            return false;
        }
    });

    changeTextarea();
});
