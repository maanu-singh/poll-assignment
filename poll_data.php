<?php
/***************************************
Author: Manvendra Singh
Created On: 23 Jun 2019
*****************************************/

session_start();
$SessionID=session_id();
require "config.php";
?>	
<!DOCTYPE html>
<html>
<head>
	<title>Poll Form</title>
		<style>
			@import url('https://fonts.googleapis.com/css?family=Montserrat');
		</style> 
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="main">
<?php 
if (isset($_REQUEST['err']) == 1) {
	echo '<center> <h3 class="errorText">Please select one option and then submit</h3></center>';
}
?>
	<div class="form_section">
		<div class="title">
			<h1>Please Give Your Opinion by Submitting Form Below.</h1>
		</div>
		<?php
		$QuestionID=1;
		$count=$dbo->prepare("SELECT * FROM poll_data WHERE QuestionID=:QuestionID LIMIT 1");
		$count->bindParam(":QuestionID",$QuestionID,PDO::PARAM_INT,1);
		if($count->execute()){
			$query = $count->fetch(PDO::FETCH_OBJ);
		}
		?>
		<form action="process_poll_data.php" method="post">
			<input type="hidden" name="QuestionID" value="<?php echo $QuestionID ?>">
			<label><h2><?php echo $query->Question ?></h2></label><br />
			<input type="radio"  class="input-format" name="OptionData" value=" <?php echo $query->Option1 ; ?>"> <?php echo $query->Option1 ; ?><br />
			<input type="radio"  class="input-format" name="OptionData" value=" <?php echo $query->Option2 ; ?>"> <?php echo $query->Option2 ; ?><br />
			<input type="radio"  class="input-format" name="OptionData" value=" <?php echo $query->Option3 ; ?>"> <?php echo $query->Option3 ; ?><br />
			<input type="radio" class="input-format" name="OptionData" value=" <?php echo $query->Option4 ; ?>"> <?php echo $query->Option4 ; ?><br />
			<br />
			<input class="submit" name="submit" type="submit" value="Submit Your Vote">
		</form>
	</div>
	<center><br />
		<?php
			//Check whether poll has vote if yes then display Show the result button
			$count=$dbo->prepare("SELECT SessionID FROM poll_answers WHERE SessionID='$SessionID'");
			$count->execute();
			$totalPollAns=$count->rowCount();
			if($totalPollAns > 0 ){
				echo "<a href='poll_result.php' class='button'>Show the Result</a>";
			}
		?>
	</center>
</div>
</body>
</html>





