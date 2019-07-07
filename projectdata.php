<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>projectdata.html</title>
  <link rel = "stylesheet" type = "text/css" href = "site.css" />
</head>
<body>
<?php
  
  date_default_timezone_set('America/Chicago');

 //read data from form
  $blazerId = filter_input(INPUT_GET, "blazerId");
  $teamNumber = filter_input(INPUT_GET, "teamNumber");
  $totalTime = filter_input(INPUT_GET, "totalTime");
  $analysisAndDesign = filter_input(INPUT_GET, "analysisAndDesign");
  $coding = filter_input(INPUT_GET, "coding");
  $testing = filter_input(INPUT_GET, "testing");
  $meeting = filter_input(INPUT_GET, "meeting");
  $other = filter_input(INPUT_GET, "other");
  $error = '';

  if(empty($_GET["blazerId"]))
 {
  $error .= '<p><label class="text-danger">Please enter your BlazerId.</label></p>';
 }
 else
 {
  if(!preg_match("/^[a-zA-Z ]*$/",$blazerId))
  {
   $error .= '<p><label class="text-danger">Please, only letters and white space allowed.</label></p>';
  }
 }
 if(empty($_GET["teamNumber"]))
 {
  $error .= '<p><label class="text-danger">Please enter your team number.</label></p>';
 }
 else
 {
  if(!preg_match("/^[a-zA-Z ]*$/",$teamNumber))
  {
   $error .= '<p><label class="text-danger">Please, only letters and white space allowed.</label></p>';
  }
 }
 if(empty($_GET["totalTime"]))
 {
  $error .= '<p><label class="text-danger">Please enter the total time.</label></p>';
 }
 else
 {
  if(!preg_match("/^[a-zA-Z ]*$/",$totalTime))
  {
   $error .= '<p><label class="text-danger">Please, only letters and white space allowed.</label></p>';
  }
 }
 if(empty($_GET["analysisAndDesign"]))
 {
  $error .= '<p><label class="text-danger">Please enter the analysis and design time.</label></p>';
 }
 else
 {
  if(!preg_match("/^[a-zA-Z ]*$/",$analysisAndDesign))
  {
   $error .= '<p><label class="text-danger">Please, only letters and white space allowed.</label></p>';
  }
 }if(empty($_GET["coding"]))
 {
  $error .= '<p><label class="text-danger">Please enter the coding time.</label></p>';
 }
 else
 {
  if(!preg_match("/^[a-zA-Z ]*$/",$coding))
  {
   $error .= '<p><label class="text-danger">Please, only letters and white space allowed.</label></p>';
  }
 }
 if(empty($_GET["testing"]))
 {
  $error .= '<p><label class="text-danger">Please enter the testing time.</label></p>';
 }
 else
 {
  if(!preg_match("/^[a-zA-Z ]*$/",$testing))
  {
   $error .= '<p><label class="text-danger">Please, only letters and white space allowed.</label></p>';
  }
 }
 if(empty($_GET["meeting"]))
 {
  $error .= '<p><label class="text-danger">Please enter the meeting time.</label></p>';
 }
 else
 {
  if(!preg_match("/^[a-zA-Z ]*$/",$meeting))
  {
   $error .= '<p><label class="text-danger">Please, only letters and white space allowed.</label></p>';
  }
 }
 if(empty($_GET["other"]))
 {
  $error .= '<p><label class="text-danger">Please enter the other time.</label></p>';
 }
 else
 {
  if(!preg_match("/^[a-zA-Z ]*$/",$other))
  {
   $error .= '<p><label class="text-danger">Please, only letters and white space allowed.</label></p>';
  }
 }
 
if($error == '')
{
 //print form results to user
 print <<< HERE
 <h1>Thank you!</h1>
 <p>
  Your record was registered correctly.
 </p>
 <p>
 Blazer ID: $blazerId <br />
 Team Number: $teamNumber <br />
 Total Time: $totalTime <br />
 Analysis and Design %: $analysisAndDesign <br />
 Coding %: $coding <br />
 Testing %: $testing <br />
 Meetings %: $meeting <br />
 Other %: $other <br />
 </p>
 <p><a href="index.html">Home</a></p>
HERE;
 //open file for output
 $csvFileOpen = fopen("projectdata.csv", "a");
 $numberOfRows = count(file("projectdata.csv")) + 1;
  $form_data = array(
   'numberOfRows'  => $numberOfRows,
   'blazerId'  => $blazerId,
   'teamNumber'  => $teamNumber,
   'totalTime'  => $totalTime,
   'analysisAndDesign' => $analysisAndDesign,
   'coding' => $coding,
   'testing' => $testing,
   'meetings' => $meeting,
   'other' => $other,
   'timestamp' =>  $date = date('Y-m-d H:i:s')
  );

  echo '<p><a href="projectdata.csv">Download csv file</a></p>';
  echo "<html><body><table>\n\n";

  //write to the file
  fputcsv($csvFileOpen, $form_data);

  //read file and print on the page
  $f = fopen("projectdata.csv", "r");
  while (($line = fgetcsv($f)) !== false) {
         echo "<tr>";
         foreach ($line as $cell) {
                 echo "<td>" . htmlspecialchars($cell) . "</td>";
         }
         echo "</tr>\n";
  }
  fclose($f);
  echo "\n</table></body></html>";
} else {
  echo $error;
  echo '<p><a href="index.html">Home</a></p>';
}
?>
</body>
</html>