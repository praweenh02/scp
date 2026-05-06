
$(document).ready(function(){
    $("select.category").change(function(){
         var csrf_token = $('input[name=csrf_token]').val();
         var category_id = $(".category option:selected").val();
      
        
        $.ajax({
            type: "POST",
            url: SITEROOT+"home/getAllGroups",
           data:{category_id:category_id, csrf_token:csrf_token}
        }).done(function(data){
            
            $("#group_id").html(data);
        });
    });
});
  function getgroupId(val){
        //Forward browser to new url
         var category_id = $(".category option:selected").val();
        window.location= SITEROOT+'group/documents/'+category_id+'/' + val+'/';
    }