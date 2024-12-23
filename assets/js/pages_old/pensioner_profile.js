$(document).ready(function() {
   
});
function Reject()
{
	var rejction_text = $("#rejection").val();
	rejction_text = $.trim(rejction_text)
	if(rejction_text.length<=0)
	{
		alert("Please enter rejection reason");
		return false;
	}
	else{
		if(rejction_text.length<=10)
		{
			alert("Please Mention Atleast 10 Character");
			return false;
		}
		else
		{
			$("#prof_action").val("REJECTED");
			$("#registrationProfile").submit();
			
		}
			
	}
		
}
function Approved()
{
	$("#prof_action").val("APPROVED");
	$("#registrationProfile").submit();
}