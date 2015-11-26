/**
 * Created by max on 10.02.15.
 */
;window.hasOwnProperty = function (obj) {return (this[obj]) ? true : false;};
if (!window.hasOwnProperty('Smile')){Smile = {};}
var Smile=Smile||{};
$(document).ready(function(){
    Smile.Langauge.init();
});
Smile.Langauge = {
    init:function(){
        $(document).on('change','#select_language', function(){
            var _this = $(this);
            $.ajax({
                type: "POST",
                url: "/backend/site/change-language",
                data:{
                    language:_this.val()
                },
                success: function(msg){
                    window.location.reload();
                }
            });
        });
    }
};
Smile.Poll = {
    init: function(){
        $(document).on('click','.add_new_answer',function(e){
            $(this).closest('.tab-pane').find('.answers_container').append(
                $(this).closest('.tab-pane').find('.answer_template').html()
            );
        });
        $(document).on('click','.remove_answer ',function(e){
            $(this).closest('.form-group').addClass('hidden').find('input').val('deleted');
        });
    }
};