
//otherContaine="";

$(document).on("change","select",function(){
 
var id= $(this).closest('.DynamicSection').attr('ms-has-other');

if(!other[id]){
	

	if($(this).find(":selected").val() == '000'){


	other[id]=1;
	var html='<input type="text" name="OtherText[]" class="form-control ms-other" placeholder="Enter Document Name" ms-other-target="'+id+'" >';

	otherContaine=html;
	var div=$(this).after(html);
	
	}


}else{
	

	if($(this).find(":selected").val() == '000'){


	}else{

	//var id=$(this).next('input').attr('ms-other-target');
	other[id]=0;
	$(this).next('.ms-other').remove();
	//console.log();

	}



}

//console.log(other);




//var input =parseInt($("[ms-input-count]").attr('ms-input-count'));
  //$("[ms-input-count]").attr('ms-input-count',input-1);



});