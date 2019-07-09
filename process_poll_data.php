<?php
/***************************************
Author: Manvendra Singh
Created On: 23 Jun 2019
*****************************************/
session_start();
$SessionID=session_id();
require "config.php";

if(!isset($_POST['OptionData'])){
	header('Location: poll_data.php?err=1');
} else {
	$OptionData=$_POST['OptionData'];
	$QuestionID=$_POST['QuestionID'];
	$sql=$dbo->prepare("INSERT INTO poll_answers(SessionID,QuestionIDFK,SelectedOption) values(:SessionID,:QuestionID,:OptionData)");
	$sql->bindParam(':SessionID',$SessionID,PDO::PARAM_STR, 100);
	$sql->bindParam(':QuestionID',$QuestionID,PDO::PARAM_INT, 1);
	$sql->bindParam(':OptionData',$OptionData,PDO::PARAM_STR, 2);
	if($sql->execute()){
		header('Location: poll_result.php');
	}
	else{
		echo "Unable to insert data!";
	}
}
?>