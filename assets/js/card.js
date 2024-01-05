/* ============================================================
 * cards
 * Create cards using Pages cards plugin. Use data attribute
 * data-pages="card" to auto-initialize a basic card without
 * the refresh option. Please refer to docs for more
 * For DEMO purposes only. Extract what you need.
 * ============================================================ */

(function($) {

    'use strict';
    $('#document-card').card({
        onCollapse: function() {
            if($('#document-card').hasClass('.card-collapsed') ){
            }else{
                $('#document-card').find('.card-body').hide();
            }
        },
        onExpand: function(){
            $('#document-card').find('.card-body').show();
        }
    });
    $('#insurance-document-card').card({
        onCollapse: function() {
            if($('#insurance-document-card').hasClass('.card-collapsed') ){
            }else{
                $('#insurance-document-card').find('.card-body').hide();
            }
        },
        onExpand: function(){
            $('#insurance-document-card').find('.card-body').show();
        }
    });
    $('#checklist-document-card').card({
        onCollapse: function() {
            if($('#checklist-document-card').hasClass('.card-collapsed') ){
            }else{
                $('#checklist-document-card').find('.card-body').hide();
            }
        },
        onExpand: function(){
            $('#checklist-document-card ').find('.card-body').show();
        }
    });

})(window.jQuery);