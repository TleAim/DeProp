$(function(){
    var provinceObject = $('#province');
    var amphureObject = $('#amphure');
    var districtObject = $('#district');

    //const amphureSelectMenu = document.getElementById("amphure");

    // on change province
    provinceObject.on('change', function(){
        var provinceId = $(this).val();

        amphureObject.prop('disabled', false);
        
        amphureObject.html('<option value="" class="text-left ps-2">เลือกอำเภอ</option>');
        districtObject.html('<option value="" class="text-left ps-2">เลือกตำบล</option>');

        $.get('../filter/get_amphure.php?province_id=' + provinceId, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                amphureObject.append(
                    
                    $('<option class="text-left ps-2"></option>').val(item.id).html(item.name_th)
                );
            });
        });
    });

    // on change amphure
    amphureObject.on('change', function(){
        var amphureId = $(this).val();

        districtObject.prop('disabled', false);
        districtObject.html('<option value="" class="text-left ps-2">เลือกตำบล</option>');
        
        $.get('../filter/get_district.php?amphure_id=' + amphureId, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                districtObject.append(
                    $('<option class="text-left ps-2"></option>').val(item.id).html(item.name_th)
                );
            });
        });
    });
});