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
// 对稳字
$('#zan').click(function (event) {
    var target = $(event.target);
    var postID = target.attr('postID');
    // 之前犯得错误是将值拿来判断，但是在下面没有修改这个值
    var is_zan = target.attr('is_zan');  //获取赞的状态
    var urls = '/posts/'+postID+'/zan';
    if (is_zan == 1){
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
                // 取消赞
                target.attr('is_zan',0);
                target.removeClass('btn-warning').addClass('btn-success');
                target.text('赞');
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
                //赞
                target.attr('is_zan',1);
                target.removeClass('btn-success').addClass('btn-warning');
                target.text('取消赞');
            }
        });
    }
});

//关注和取消关注
$('.follow').click(function (event) {
    var target = $(event.target);
    var url = target.attr('follow-url');
    var uid = target.attr('uid');
    var is_follow = target.attr('is_follow');
    if (is_follow > 0){
        url = url + '/unFollow';
    }else{
        url = url + '/follow';
    }
    $.ajax({
        url: url,
        method: 'POST',
        dataType: 'json',
        data:{'uid':uid},
        success:function(data){
            if (data.error != 0){
                return;
            }
            if (is_follow > 0){
                //取消关注
                target.attr('is_follow',0);
                target.text('关注');
            }else{
                //关注
                target.attr('is_follow',1);
                target.text('取消关注');
            }
        }
    });
});

//文章收藏
$('.like-post').click(function (event) {
    var target = $(event.target);
    var url = target.attr('like-url');
    var like_value = target.attr('like-valued');
    var post_id = target.attr('post_id');
    if( like_value ==1 ){
        $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            data: { 'post_id': post_id },
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

// 文章的审核通过和拒绝
//通过
$('.post-audit').click(function (event) {
    var target = $(event.target);
    var status = target.attr('post-action-status');
    var post_id = target.attr('post-id');
    var url = '/admin/posts/status';
    $.ajax({
        url : url,
        method: "POST",
        dateType: "JSON",
        data: { 'status':status , 'post_id':post_id ,'_method':'PUT'},
        success: function (data) {
            if (data.error != 0){
                alert(data.msg);
            }
            console.log(data);
        }

    });
});