<?Php
/***************************************
Author: Manvendra Singh
Created On: 23 Jun 2019
*****************************************/

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
	<div class="contr">
<?php
$QuestionID=1;
$count=$dbo->prepare("SELECT Question FROM poll_data WHERE QuestionID=:QuestionID");
$count->bindParam(":QuestionID",$QuestionID,PDO::PARAM_INT,3);

if($count->execute()){
	$row = $count->fetch(PDO::FETCH_OBJ);
}else{
	echo "Database issue!";
}

echo "<label><h2>$row->Question</h2></label>";


$count=$dbo->prepare("SELECT AnsID FROM poll_answers WHERE QuestionIDFK=:QuestionID");
$count->bindParam(":QuestionID",$QuestionID,PDO::PARAM_INT,3);
$count->execute();
$totalVotes=$count->rowCount();
echo "<h3 class='totalVotes'>Total votes ".$totalVotes . "</h3>"; 

$getHighestVotedOptionQry = $dbo->prepare("SELECT COUNT(AnsID) as HighestVoted FROM poll_answers GROUP BY SelectedOption Order by COUNT(AnsID) DESC");
$getHighestVotedOptionQry->execute();
$getHighestVotedOption = $getHighestVotedOptionQry->fetchColumn();

/* Find out the answers and display the graph */
$sql="SELECT count(*) as NumberOfRec, Question, SelectedOption FROM poll_data pd, poll_answers pa WHERE pd.QuestionID=pa.QuestionIDFK and pd.QuestionID='1' group by SelectedOption";
?>
<table cellpadding='0' cellspacing='0' border='0' class="resultTbl">
<?php
foreach ($dbo->query($sql) as $answersData) {
	if($answersData["NumberOfRec"] == $getHighestVotedOption)
	{
		$highlightRow = 'highlightRowClass';
	} else {
		$highlightRow = 'dontHighlightRowClass';

	}
	echo "<tr class='$highlightRow'><td width=''><span class='options'>$answersData[SelectedOption]</span></td>";
	$width2=$answersData["NumberOfRec"] *10 ; 
	echo "<td width=''><span class='numberOfVotes'>($answersData[NumberOfRec])</span></td>";
	echo "<td width=''><img src='css/graph.jpg' height=10 width=$width2></td> </tr>";
}
echo "</table>";
?>
</div>
<center>
<a href=poll_data.php  class='button'>Show Poll</a>
