$("html").on("change","input",function (){

	//alert($(this).attr('name'));


	switch($(this).attr('type')) {
  case 'text':
   if($(this).val().length < 1 ){
      $(this).parent('.form-group').addClass('ms-has-danger');
}else{
	$(this).parent('.form-group').removeClass('ms-has-danger');
}

    break;

  default:
    // code block
}





});


$("html").on("focusout","input",function (){

	//alert($(this).attr('name'));


	switch($(this).attr('type')) {
  case 'text':


    break;
 
  default:
    // code block
}





});