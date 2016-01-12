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