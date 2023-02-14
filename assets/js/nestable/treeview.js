/**
 * Created by pitb on 2018-08-17.
 */

$(document).ready(function () {
    $(function () {
        $("input[type='checkbox']").click(function () {
            $(this).siblings('ol')
                .find("input[type='checkbox']")
                .prop('checked', this.checked);
        });
    });
    $('li input[type="checkbox"]').change(function () {
        var $lis = $(this).closest('li').parent().parentsUntil('#treeList', 'li');
        $lis.each(function () {
            var $this = $(this);
            $this.children('input').prop('checked', $this.find('ol input:checked').length > 0)
        });
    });

    $(".listings ol li:nth-last-child(1)").css("border-left", '4px solid darkred','padding-left', '35px','left','13px !important');

});


jQuery(function ($) {
    $('.dd-draghandle').nestable('collapseAll');
    $('.dd').nestable('collapseAll');
    $('#nestable-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });
    $('.dd-handle a').on('mousedown', function (e) {
        e.stopPropagation();
    });
});