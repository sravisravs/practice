//employee id validation
$(document).ready(function()
{$("#empid").focus(function()
{
var val=$("#empname").val();
if(val=="")
{
$("#empnamespan").text("please enter name");
$("#empnamespan").css("color","red");
$("#empname").focus();
return false;
}
else
{
$("#empnamespan").text("");
return true;
}
});
});

//employee department validation
$(document).ready(function()
{$("#dept").focus(function()
{
var val=$("#empid").val();
if(val=="")
{
$("#empidspan").text("please enter id");
$("#empidspan").css("color","red");
$("#empid").focus();
return false;
}
else
{
$("#empidspan").text("");
return true;
}
});
});

//employee teamlead validation
$(document).ready(function()
{$("#teamlead").focus(function()
{
var val=$("#dept").val();
if(val=="none")
{
$("#empdeptspan").text("please select department");
$("#empdeptspan").css("color","red");
$("#dept").focus();
return false;
}
else
{
$("#empdeptspan").text("");
return true;
}
});
});


//employee position validation
$(document).ready(function()
{$("#pos").focus(function()
{
var val=$("#teamlead").val();
if(val=="none")
{
$("#emptlspan").text("please select teamlead");
$("#emptlspan").css("color","red");
$("#teamlead").focus();
return false;
}
else
{
$("#emptlspan").text("");
return true;
}
});
});

//form submit validation
$(document).ready(function()
{$("#mainform").submit(function()
{
var val=$("#pos").val();
if(val=="")
{
$("#empposspan").text("please enter position");
$("#empposspan").css("color","red");
$("#pos").focus();
return false;
}
else
{
$("#empposspan").text("");	
return true;
}
});
});



