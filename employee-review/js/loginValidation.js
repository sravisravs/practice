/*$(document).ready(function()
{$("#upwd").focus(function()
	{
		if(($("#uname").val())=="")
		{
			$("#unamespan").text("please enter user name");
			$("#unamespan").css("color","red");
			$("#uname").focus();
			return false;
		}
		else{
			$("unamespan").text("");
			return true;
		}
		alert("hello");
	});
});
*/

$(document).ready(function()
{$("#upwd").focus(function()
{
var val=$("#uname").val();
if(val=="")
{
$("#unamespan").text("please enter name");
$("#unamespan").css("color","red");
$("#uname").focus();
return false;
}
else
{
$("#unamespan").text("");
return true;
}
});
});
$(document).ready(function()
{$(".container").submit(function()
{
var val=$("#upwd").val();
if(val=="")
{
$("#upwdspan").text("please enter password");
$("#upwdspan").css("color","red");
$("#upwd").focus();
return false;
}
else
{
$("#upwdspan").text("");
return true;
}
});
});
