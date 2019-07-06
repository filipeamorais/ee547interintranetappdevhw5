<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>addContact.html</title>
 <link rel = "stylesheet"
  type = "text/css"
  href = "contact.css" />
</head>
<body>
 <?php
 //read data from form
 $blazerId = filter_input(INPUT_GET, "blazerId");
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
 first name: $blazerId <br />
 last name: $totalTime <br />
 email: $analysisAndDesign <br />
 phone: $coding
 </p>
HERE;
 //generate output for text file
 $output = <<< HERE
first: $fName
last: $lName
email: $email
phone: $phone
HERE;
 //open file for output
 $csvFile = fopen("projectdata.csv", "a");
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
   'other' => $other
  );
 //write to the file
 fwrite($fp, $output);
 fclose($fp);


 date_default_timezone_set('America/Chicago');
 $timezone = date_default_timezone_get();
 $date = date('Y-m-d H:i:s');
echo "The current server timezone is: " . $timezone;
echo $date;
 ?>
</body>
</html>