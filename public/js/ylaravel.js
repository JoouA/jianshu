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