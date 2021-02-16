<?php 
	

	function contact_technicians()
	{
		return ("<center> <br> <br> <br> <br> <strong style=\"color: red; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">Sorry there was an error, contact the technicians for fixing.</strong> <br> <br> </center>");
	}

	function unrecognised_error()
	{
		return ("<center> <br> <strong style=\"color: red; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">Sorry there was an unrecognised error.</strong> <br> <br> </center>");
	}



	function try_again()
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">Please try again.</strong> <br> <br> </center>");
	}

	function no_campus()
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">No Campus created.</strong> <br> <br> </center>");
	}

	function no_student_type()
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">No Student type created.</strong> <br> <br> </center>");
	}

	function no_student_($prog_department="this")
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">No Student found for this $prog_department.</strong> <br> <br> </center>");
	}


	function no_department()
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">No Department created.</strong> <br> <br> </center>");
	}


	function no_program()
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">No Program created.</strong> <br> <br> </center>");
	}


	function no_student_added()
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">No Student Added.</strong> <br> <br> </center>");
	}



	function no_staff_added()
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">No Staff Added.</strong> <br> <br> </center>");
	}



	function no_access_code_generated()
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">No Student Selected.</strong> <br> <br> </center>");
	}


	function type_to_search()
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">Please type Index Number to search for student.</strong> <br> <br> </center>");
	}



	function no_student_found()
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">No Student found with this Index Number.</strong> <br> <br> </center>");
	}


	function student_not_found()
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">Student not found.</strong> <br> <br> </center>");
	}


	function no_candidate_added()
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">No Candidate found.</strong> <br> <br> </center>");
	}




	function no_candidate_found_for_added($position="this")
	{
		return ("<center> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">No Candidate found for $position Position.</strong> <br> <br> </center>");
	}



	function has_voted_for_section()
	{
		return ("<center> <br> <br> <br> <br> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">You have already voted for this section</strong> <br> <br> </center>");
	}




	function no_department_found_with($what="this")
	{
		return ("<center> <br> <br> <br> <br> <br> <strong style=\"color: blue; font-size: 18px; text-shadow: 1px 0px rgba(0,0,0,0.5);\">No Student found with a $what.</strong> <br> <br> </center>");
	}


 ?>