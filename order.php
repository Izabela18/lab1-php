<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);



function searchCode($countryCode) {//declaring new function that searches for countryCode
  $file = 'international-orders.csv';//declaring all necessary variables
  $totalsum = 0;
  $pos;
  $id;
  $returString;
  $allID = "Success";


// Check the existence of file
if(file_exists($file)){
    // The file() reads a file into an array.
    $content = file($file) or die("ERROR: Cannot open the file.");


      foreach ($content as $row) {//foreach reads the whole array as $content into lines(rows) with values
        $rad = explode(",", $row);// explode() breaks the string $row(value from higher array) into an array with the delimeter ",", so we have 3 values in a subarray(id, antal, pris)
        $id = $rad[0];//naming the new array values into variables
        $antal = $rad[1];
        $pris = (int)$rad[2];//changes pris values into int, as it read before as string
        $pos = strpos($id, $countryCode);//it finds the first occurrence of $countryCode inside the string

          if($pos !== false) {//if it finds $countryCode in $id do as below

            $totalsum += $antal * $pris;//summing all orders

            $allID .= "\n$id";//listing up all found orders
            $returString = $allID. "\nThe total order sum for ". $countryCode . " is: " . $totalsum;

          }
      }

      if($totalsum == 0) {//if totalsum = 0 reads as not code found
      $returString = "FAILURE. Country code not found";
        }

            echo $returString;

      }

  $myfile = fopen($countryCode. date('Ymd-his').'.csv', "w") or die("Unable to open file!");//setting a format for output .csv files and creating the file
  fwrite($myfile, $returString);//writing result in the files
  fclose($myfile);//closing the files

  }


searchCode("US");//calling the function
//searchCode("Fel");

?>
