if($("#error").length){

$("#error").slideUp("5");
}


$(document).on("click",".RemoveSectionBtn",function(){
 
  var id2=  $(this).closest('.DynamicSection').attr('ms-has-other'); 

  other[id2]=0;
  $(this).closest('.DynamicSection').remove();
 // alert($("[ms-input-count]").attr('ms-input-count'));
var input =parseInt($("[ms-input-count]").attr('ms-input-count'));
  $("[ms-input-count]").attr('ms-input-count',input-1);

});





function getMsModLink(link) {
$(".ms-mod-tab").slideUp("fast");
loadingOn();




$.ajax({
                url: link,  //server script to process data
                type: 'GET',
                xhr: function() {  // custom xhr
                    myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){ // if upload property exists
                       // myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // progressbar
                    }
                    return myXhr;
                },
                // Ajax events
                success: completeHandler = function(data) {
                
                console.log(typeof data);

                if(typeof data == "object"){
                  console.log( data);

                  if('redirectLink' in data){

                     window.location.replace(data.redirectLink);

                  }

                  if('redirectData' in data){
                 
                  $(".ms-mod-tab").html(data);
                  $(".ms-mod-tab").slideDown("fast");
                   

                  }


                  if('redirectModData' in data){
                    


                    $.get( data.redirectModData, function( data2 ) {
                        $(".ms-mod-tab").html(data2);
                        $(".ms-mod-tab").slideDown("fast");
                      });
                   

                  }

                 

                }else
                {

                   $(".ms-mod-tab").html(data);
                  $(".ms-mod-tab").slideDown("fast");

                }

            

              
                },
                error: errorHandler = function(xhr, status, error) {
                                   if(xhr.status == 422){
                         $('html, body').animate({
                            scrollTop: $("#error").offset().top
                           }, 300);

                       alert(status+': Access Denied');
                       }

                 
       


          

                },
                cache: false,
                contentType: false,
                processData: false
            }, 'json');

                 $(".ms-mod-tab").slideDown("fast");
                 loadingOff();

}

function loadingOn() {
  
 $(".loading").fadeIn( "slow", function() {
    // Animation complete
  });;




}


function loadingOff() {
  
   $(".loading").fadeOut( "slow", function() {
    // Animation complete
  });

}