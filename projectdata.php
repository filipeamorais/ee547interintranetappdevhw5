<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>projectdata.html</title>
  <link rel = "stylesheet" type = "text/css" href = "contact.css" />
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
 $numberOfRows = count(file("projectdata.csv"));
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

  echo '<p><a href="index.html">Printable report</a></p>';
  echo '<p><a href="index.html">Download csv file</a></p>';
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
?>
</body>
</html>