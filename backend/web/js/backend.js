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
            $('.tab-pane').find('.answers_container').each(function(){
                $(this).append($(this).closest('.tab-pane').find('.answer_template').html());
            })
        });
        $(document).on('click','.remove_answer ',function(e){
            var index = $(this).closest('.form-group').index();
            $('.answers_container_main').each(function(){
                $(this).find('.answer_input').eq(index).val('deleted').closest('.form-group').addClass('hidden');
            });
        });
        $(document).on('submit','#poll_form',function(){
             $(this).find('.answer_template').remove();
        });
        $(document).on('click','.remove_my_answer',function(){
            $(this).closest('.form-group').remove();
        });
        $(document).on('change','.my_version_checkbox',function(){
            if($(this).is(":checked")) {
                $('.my_answers_container').show();
            }else{
                $('.my_answers_container').hide();
            }
        });
    }
};
Smile.Image = {
    init: function(){
        $('#images-upload-fileupload tbody.files').sortable({
            update: function(event, ui){
                var arr = {};
                $('#images-upload-fileupload tbody.files tr').each(function(key, elem){
                    $(elem).attr('data-order',key+1);
                    arr[$(elem).data('id_image')] = {order:key+1,class_id:$(elem).data('class_id'),class:$(elem).data('class')};
                });
                console.log(arr);
                $.ajax({
                    type: "get",
                    url: "/backend/dropzone/drop-zone/sort",
                    data:{
                        image:arr
                    },
                    success: function(msg){
                        console.log(msg);
                    }
                });
            }
        });
        $('#images-upload-fileupload tbody.files').disableSelection();
    },
    calculateFileSize:function(bytes){
        if (typeof bytes !== 'number') {
            return '';
        }
        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }
        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }
        return (bytes / 1000).toFixed(2) + ' KB';
    }
};
Smile.News = {
    init:function(){
        if($('.news_change_type').val() && typeof $('.news_change_type').val() == 'object'){
            $('.news_change_type').val().map(function(value){
                $('.types_fields.'+value).show();
            });
        }
        $('.news_change_type').on('change',function(){
            $('.types_fields').hide();
            if($(this).val() && typeof $(this).val() == 'object'){
                $(this).val().map(function(value){
                    $('.types_fields.'+value).show();
                });
            }
        })
    }
};

Smile.Grid = {
    init:function(){
        $('#mass_action_submit').on('click',function(e){
            e.preventDefault();
            if($('#mass_action_actions').val()){
                $.each($('.mass_action_checkbox:checked'),function(index,element){
                    $.ajax({
                        type:'GET',
                        url:$('#mass_action_actions').val(),
                        data:{
                            id:$(element).val()
                        },
                        success:function(data)  {
                            $.pjax.reload('#pjax-mass-action');
                        }
                    });
                });
            }
        });
    }
};