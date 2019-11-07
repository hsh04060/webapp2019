<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Store</title>
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existence of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		$names=array("CSE326","CSE107","CSE603","CIN870");
		if ((isset($_POST["name"])===false) || ($_POST["name"]==="")
		|| (isset($_POST["id"])===false) || ($_POST["id"]==="")
		|| ((isset($_POST["$names[0]"])===false)&&(isset($_POST["$names[1]"])===false)&&(isset($_POST["$names[2]"])===false)&&(isset($_POST["$names[3]"])===false))
		|| (isset($_POST["cardnum"])===false) || ($_POST["cardnum"]==="")
		|| (isset($_POST["cardtype"])===false)) {
		?>

		<!-- Ex 4 : 
			Display the below error message : -->
		<h1>Sorry</h1>
		<p>You didn't fill out the form completely.
		<a href="http://localhost/lab06/gradestore.html">Try again?</a></p>

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		} elseif (!(preg_match("/^[a-zA-Z_\-]*(( ){1})?[a-zA-Z]*$/",$_POST["name"]))) { 
		?>

		<!-- Ex 5 :
			Display the below error message : -->
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. <a href="http://localhost/lab06/gradestore.html">Try again?</a></p>

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		} elseif ((!(preg_match("/^\d{16}$/",$_POST["cardnum"])))
		||($_POST["cardtype"]==="visa" && !(preg_match("/^4\d{15}$/",$_POST["cardnum"])))
		||($_POST["cardtype"]==="mastercard" && !(preg_match("/^5\d{15}$/",$_POST["cardnum"])))
		) {
		?>

		<!-- Ex 5 : 
			Display the below error message : -->
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="http://localhost/lab06/gradestore.html">Try again?</a></p>

		<?php
		# if all the validation and check are passed  
		} else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<ul>
			<?php 
				$names=array("CSE326","CSE107","CSE603","CIN870");
				$name = $_POST["name"];
				$id = $_POST["id"];
				$grade = $_POST["grade"];
				$cardnum = $_POST["cardnum"];
				$cardtype = $_POST["cardtype"];
			?> 
			<li>Name: <?= $name ?></li>
			<li>ID: <?= $id ?></li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course: <?= processCheckbox($names) ?></li>
			<li>Grade: <?= $grade ?></li>
			<li>Credit <?= "$cardnum ($cardtype)" ?></li>
		</ul>
		
		<!-- Ex 3 : -->
		<p>Here are all the loosers who have submitted here:</p>
		<?php
			$filename = "loosers.txt";
			/* Ex 3: 
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
			
			$content = "\n$name;$id;$cardnum;$cardtype";
			file_put_contents($filename,$content,FILE_APPEND);
		?>
		
		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->
		<pre><?= file_get_contents($filename) ?></pre>
		<?php
		}
		?>
		
		<?php
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma separation.
			 * For example, "cse326, cse603, cin870"
			 */
			function processCheckbox($names){
				$course_name="";
				for($i=0;$i<count($names);$i++) {
					if(isset($_POST["$names[$i]"])) {
						$course_name=$course_name.$names[$i].' ';
					}
				}
				$course_name=explode(" ",trim($course_name));
				$course_name=implode(", ",$course_name);
				return $course_name;
			}
		?>
		
	</body>
</html>
