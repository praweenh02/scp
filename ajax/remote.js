var serverLocation = "https://tec.gov.in/scp/";
var SITEROOT = serverLocation;
var SITECSS = serverLocation + "/templates/default/css";
var SITEJS = serverLocation + "/templates/default/js";
var SITEIMG = serverLocation + "/templates/default/images";
//var AWSPATH = "https://scipbucket.s3.ap-south-1.amazonaws.com";
// JavaScript Document
$(document).ready(function () {
    $(".errorMsg,.successMsg,.warningMsg").fadeOut(10000);
    $(".error_msg,.success_msg").fadeOut(10000);
    setInterval("get_message_count();", 60000);
});

function showloader()
{
    $('#fade').fadeIn();
    $('#loader').fadeIn();
}
function hideloader()
{
    $('#fade').fadeOut();
    $('#loader').fadeOut();
}

$(function () {
    var url = document.location.toString();
   
    if (url.match('#')) {
        $('.nav-tabs a[href=#' + url.split('#')[1] + ']').tab('show');
    }
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
        $(window).scrollTop(0);
    })
    
    if(url.split('#')[1] == 'tab_1') {
         $(window).scrollTop(0);
    }
    
    if (url.match('#')) {
        $('.nav-pills a[href=#' + url.split('#')[1] + ']').tab('show');
    }
    $('.nav-pills a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
    })
    
});
function back()
{
    window.history.go(-1);
}

function search_data() {

    $('#frmSearch').submit();

}

function change_user_type_from_menu(userTypeId) {

    if (userTypeId != 'all')
    {
        $('.clsUserTypeMul').prop('checked', false);
        $('#' + userTypeId).prop('checked', true);
    }
    else
    {
        $('.clsUserTypeMul').prop('checked', false);
    }
}

function makeNotificationAsRead(notificationId) {

    if (notificationId > 0) {
        $.post(SITEROOT + '/notification/makeNotificationAsRead', {
            notificationId: notificationId

        }, function (data) {

            $('.SCIPNOTIROW' + notificationId).addClass('clsReadNoti');
            $('.SCIPNOTIROW' + notificationId).removeClass('clsNotReadNoti');

            $('.clsMenuNotiCnt').html($.trim(data));

        });
    }
}

// investorId  check_investor_as_syndicate
function check_investor_as_syndicate(investorId) {
    $.post(SITEROOT + '/admin/login/check_investor_as_syndicate', {
        investorId: investorId
    }, function (data) {
        var syndicateId = $.trim(data);
        if (syndicateId > 0) {
            var liUrl = '<li><a href="javascript:void(0);" onclick="set_user_session_from_web(' + syndicateId + ');" ><span class="tab">Syndicate Home </span></a></li>';
            $(".syndicateULCls").append(liUrl);
            //  $("#syndicateUL").append(liUrl);
            //console.log(liUrl);
            // set_user_session_from_admin(investorId);
        }
    });
}

function set_signup_utype(signup_utype) {

    $.post(SITEROOT + '/admin/login/set_signup_utype', {
        signup_utype: signup_utype
    }, function (data) {
        if ($.trim(data)) {

            window.location = data;
        }
    });
}

function set_user_session_from_web(userId) {

    $.post(SITEROOT + '/admin/login/set_user_session_from_web', {
        userId: userId
    }, function (data) {
        if ($.trim(data)) {
            window.open(
                    data,
                    '_blank' // <- This is what makes it open in a new window.
                    );
        }
    });
}

$(document).ready(function () {

    if (typeof gUTYPE != 'undefined')
    {
        if (gUTYPE == 'investor')
        {
            check_investor_as_syndicate(gUID);
        }
    }
});

function open_popup_by_id(id)
{
    $('.clearMe').val('');
    $('.clearMe').attr('checked', false); // Unchecks it
    $('.error').html('');
    $('#'+id).modal('show');

}

function get_message_count() {
    $.post(SITEROOT + '/message/get_message_count', {}, function (data) {
        $(".msgcnt").html(data);
    });
}

function get_draft_document(userId,id) {
    $('#popupdiv').html('');
    $('.modal-backdrop').remove();
    $.post(SITEROOT + '/entrepreneur/get_draft_document', {userId: userId,id:id}, function (data) {
        if ($.trim(data)) {
            $('#popupdiv').html(data);
            $('#draftModal').modal('show');
        }
    });
}

function pushurl(uri){
    var url = SITEROOT+"/"+uri;
    var stateObject = {};
    var title = "";
    history.pushState(stateObject,title,url);
}

function hideModal(){
    $('.modal').hide();
    $('.modal-backdrop').remove();
    $('body').removeClass( "modal-open" );
    $('#popupdiv').html('');
}

function upddate_notification(notificationId) {
    $.post(SITEROOT + '/entrepreneur/upddate_notification', {notificationId: notificationId}, function (data) {
        if ($.trim(data)) {
                window.location = SITEROOT + '/entrepreneur/home';
        }
    });
}


$(document).ready(function() {
  function setHeight() {
       // var height = $(".top-head").height() + $("#footWrapper").height()
        var height = $("#footWrapper").height()
        windowHeight = $(window).innerHeight();
        windowHeight = parseInt(windowHeight) - parseInt(height);
        $('.section').css('min-height', windowHeight);
  };
  setHeight();
  $(window).resize(function() {
        setHeight();
  });
});

$("body").on('click',".pagination  li a",function(e){
        if(this.id != 'active')
        {
            e.preventDefault();
            showloader();
             if($(document).height() < 1000) {
                $(".top-head").removeAttr('data-sticky');
            }
        }
       
})

$(document).ready(function() {
   var is_login = $.trim($('#is_login').val());
   is_login == is_login > 0 ? is_login : 0;
   if(is_login == 0) {
           $('.removeMe').hide();
   }
});


function go_redirect(url) 
{
   location.href = url;
}


function popup(url) {
    var randomnumber = Math.floor((Math.random()*100)+1); 
    window.open(url,"_blank",'PopUp'+randomnumber+',left=50,top=50,toolbar=yes,scrollbars=yes,menubar=yes,resizable=yes,height=700,width=1400');
}

var openFile = function (event,imgId) {
    var fileTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg'];  //acceptable file types
    var input = event.target;
    if (input.files && input.files[0]) {
    var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
    isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types
    if (isSuccess) {
          var reader = new FileReader();
          reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById(imgId);
            output.src = dataURL;
          };
          reader.readAsDataURL(input.files[0]);
      }
    }
  };
  

