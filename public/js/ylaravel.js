$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function confirm_delete()
{
    if(confirm('确定删除？') === true){
        return true;
    }else{
        return false;
    }
}

//二级联动关于省市的联动
$('#province').change(function(){
    var provincialID = $(this).val();
    $.ajax({
        url:'/cities',
        type:'post',
        dataType:'json',
        data:{'provincialID':provincialID},
        timeout:30000,
        success:function(data){
            $('#city').empty();
            var count = data.length;
            var i = 0;
            var b = '';
            for(i=0;i<count;i++){
                b+="<option value='"+data[i].cityID+"'>"+data[i].cityName+"</option>";
            }
            $('#city').append(b);
        }
    });
});

//赞和取消赞
$('#zan').click(function (event) {
    var target = $(event.target);
    var postID = target.attr('postID');
    var content = target.attr('current_zan');  //获取内容
    var urls = '/posts/'+postID+'/zan';

    if (content == '赞'){
        $.ajax({
            url: urls,
            type: 'POST',
            dataType: 'json',
            data: {'postID':postID },
            timeout: 3000,
            success: function (data) {
                if(data.error == 1){
                    return ;
                }

                target.text('取消赞');
            }
        });
    }else{
        $.ajax({
            url: urls,
            type: 'POST',
            dataType: 'json',
            data: {'postID':postID },
            timeout: 3000,
            success: function (data) {
                if(data.error == 1){
                    return ;
                }

                target.text('赞');
            }
        });
    }
});

$('.like-post').click(function (event) {
    var target = $(event.target);
    var url = target.attr('like-url');
    var like_value = target.attr('like-valued');

    if( like_value ==1 ){
        $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            success: function (data) {
                if (data.error != 0){
                    alert(data.msg);
                }
                target.attr('like-valued',0);
                target.text('收藏');
            }
        });
    }else{
        $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            success: function (data) {
                if (data.error != 0){
                    alert(data.msg);
                }
                target.attr('like-valued',1);
                target.text('取消收藏');
            }
        });
    }
});