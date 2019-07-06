<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>projectdata.html</title>
 <link rel = "stylesheet"
  type = "text/css"
  href = "contact.css" />
</head>
<body>
 <?php
date_default_timezone_set('America/Chicago');

 //read data from form
 $blazerId = filter_input(INPUT_GET, "blazerId");
 $teamNumber = filter_input(INPUT_GET, "teamNumber");
 $totalTime = filter_input(INPUT_POST, "totalTime");
 $analysisAndDesign = filter_input(INPUT_POST, "analysisAndDesign");
 $coding = '';
 $testing = '';
 $meetings = '';
 $other = '';
 //print form results to user
 print <<< HERE
 <h1>Thanks!</h1>
 <p>
  Your spam will be arriving shortly.
 </p>
 <p>
 Blazer ID: $blazerId <br />
 Total Time: $totalTime <br />
 Analysis and Design %: $analysisAndDesign <br />
 Coding %: $coding
 </p>
HERE;
 //open file for output
 $csvFileOpen = fopen("projectdata.csv", "a");
 $numberOfRows = count(file("projectdata.csv"));
 if($numberOfRows > 1)
  {
    $numberOfRows = ($numberOfRows - 1) + 1;
  }
  $form_data = array(
   'numberOfRows'  => $numberOfRows,
   'blazerId'  => $blazerId,
   'totalTime'  => $totalTime,
   'analysisAndDesign' => $analysisAndDesign,
   'coding' => $coding,
   'testing' => $testing,
   'meetings' => $meetings,
   'other' => $other,
   'timestamp' =>  $date = date('Y-m-d H:i:s')
  );
 //write to the file
 fputcsv($csvFileOpen, $form_data);

 echo "<html><body><table>\n\n";
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