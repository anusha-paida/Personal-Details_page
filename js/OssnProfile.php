$(document).ready(function(){
	var index=0;
	$("#add_experience").click(function(){
		index++;
		document.getElementById('expcount').value = index;
		$(this).parent().before($("#experience_form").clone().attr("id","experience_form" + index));
        $("#experience_form" + index).show();
        $("#experience_form" + index + " :input").each(function(){
            $(this).attr("name",$(this).attr("name") + index);
            $(this).attr("id",$(this).attr("id") + index);
            });
        $("#remove_experience" + index).click(function(){
            $(this).closest("div").remove();
        });
    }); 
});
$(document).ready(function(){
	var index=0;
	$("#add_education").click(function(){
		index++;
		document.getElementById('educount').value = index;
		$(this).parent().before($("#education_form").clone().attr("id","education_form" + index));
        $("#education_form" + index).show();
        $("#education_form" + index + " :input").each(function(){
            $(this).attr("name",$(this).attr("name") + index);
            $(this).attr("id",$(this).attr("id") + index);
            });
        $("#remove_education" + index).click(function(){
            $(this).closest("div").remove();
        });
    }); 
});
$(function(){
    $(".edit").click(function(){
        var id = document.getElementById('exp').value
        
        var $this = $(this);
        var text = $this.text();
        $(".editable"+ id).toggle();
    });

});

function setValueexp(id)
{
	console.log("In Set Value function" + id);
	document.getElementById('exp').value = id;
	
			}
		
function saveValueExp(id)
{
	var fd = new FormData();
	fd.append("id",id);
	fd.append("companyname",document.getElementById("company"+id).value);
	fd.append("title",document.getElementById("title"+id).value);
	fd.append("location",document.getElementById("location"+id).value);
	fd.append("startdate",document.getElementById("startdate"+id).value);
	fd.append("enddate",document.getElementById("enddate"+id).value);
	fd.append("position",document.getElementById("position"+id).value);
	fd.append("description",document.getElementById("description"+id).value);
	$url = Ossn.site_url + "action/profile/edit/saveexp";
	$.ajax({
		async: true,
		type: 'post',
		url: Ossn.AddTokenToUrl($url),
		data:fd,
		cache: false,
		contentType:false,
		processData: false,
		success: function ( data ) {
            console.log( data );
        }
		
	});
	
	location.reload(true);
}

function cancelValueExp(id)
{
	$(".editable"+ id).toggle();	
}

function deleteValueExp(id)
{
	var fd1 = new FormData();
	fd1.append("id",id);
	$url = Ossn.site_url + "action/profile/edit/deleteexp";
	$.ajax({
		async: true,
		type: 'post',
		url: Ossn.AddTokenToUrl($url),
		data:fd1,
		cache: false,
		contentType:false,
		processData: false,
		success: function ( data ) {
            console.log( data );
        }
			});
	location.reload(true);
}		
$(function(){
    $(".edit").click(function(){
        var id = document.getElementById('edu').value
        
        var $this = $(this);
        var text = $this.text();
        $(".editable"+ id).toggle();
    });

    $("input.editable").change(function(){
        $(this).prev().text($(this).text());

    });
});
function setValueedu(id)
{
	console.log("In Set Value function" + id);
	document.getElementById('edu').value = id;

}
function saveValueEdu(id)
{
	var fd = new FormData();
	fd.append("id",id);
	fd.append("school",document.getElementById("school"+id).value);
	fd.append("degree",document.getElementById("degree"+id).value);
	fd.append("studyfield",document.getElementById("studyfield"+id).value);
	fd.append("startdate",document.getElementById("startdate"+id).value);
	fd.append("enddate",document.getElementById("enddate"+id).value);
	fd.append("courses",document.getElementById("courses"+id).value);
	fd.append("associations",document.getElementById("associations"+id).value);
	$url = Ossn.site_url + "action/profile/edit/saveedu";
	$.ajax({
		async: true,
		type: 'post',
		url: Ossn.AddTokenToUrl($url),
		data:fd,
		cache: false,
		contentType:false,
		processData: false,
		success: function ( data ) {
            console.log( data );
        }
		
	});
	
	location.reload(true);
}
function cancelValueEdu(id)
{
	$(".editable"+ id).toggle();
	
}

function deleteValueEdu(id)
{
	var fd1 = new FormData();
	fd1.append("id",id);
	$url = Ossn.site_url + "action/profile/edit/deleteedu";
	$.ajax({
		async: true,
		type: 'post',
		url: Ossn.AddTokenToUrl($url),
		data:fd1,
		cache: false,
		contentType:false,
		processData: false,
		success: function ( data ) {
            console.log( data );
        }
			});
			location.reload(true);
}
function presentCheckexp(){
	var index = document.getElementById('expcount').value;
	if(document.getElementById("presentexp" + index).checked){
    $("#enddate" + index).hide();
    }
    else{
     $("#enddate" + index).show();
    }

	}
function presentCheckedu(){
	var index = document.getElementById('educount').value;
	if(document.getElementById("presentedu" + index).checked){
    $("#enddate" + index).hide();
    }
    else{
     $("#enddate" + index).show();
    }

	}		