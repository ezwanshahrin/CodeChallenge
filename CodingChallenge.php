<?php

Class CodingChallenge {

 public function print_form() {

  echo '
  <h2>Code Challenge</h2>
  <form action="'.$SERVER['PHP_SELF'].'" method="post">
   <label>Your Input : </label>
   <input type="text" name="input" placeholder="Insert anything here.." required>
   <input type="submit" value="Submit" name="submit">
  </form>';
 }

 public function get_result($str) {

  $str_uc = strtoupper($str);
  $str_uc_arr = str_split($str_uc);

  $alt_case = '';

  foreach($str_uc_arr as $key => $val) {

   $position = $key+1;

   $alt_str = ($position%2) ? strtoupper($val) : strtolower($val);

   $alt_case .= $alt_str;
  }

  echo '
  Uppercase : '.$str_uc.'<br>
  Alternate-Casing : '.$alt_case.'<br>
  <form action="'.$SERVER['PHP_SELF'].'" method="post">
   <input type="hidden" name="input" required readonly value="'.$str.'">
   <input type="submit" value="Download" name="download">
  </form>';

 }

 public function download($str_array) {

  header('Content-Type: text/csv; charset=utf-8'); 
  header('Content-Disposition: attachment; filename=CodeChallenge.csv'); 

  $output = fopen('php://output', 'w'); 

  fputcsv($output, $str_array);

 }

 public function display_error() {

  echo 'Error! <br>';
  echo '<a href="'.$SERVER['PHP_SELF'].'"><button type="button">Back</button></a>';
 }
 
}

$obj = new CodingChallenge;

if(isset($_POST["submit"])) {

 if(!empty($_POST["input"])) {
  $obj->get_result($_POST["input"]);
 } else {
  $obj->display_error();
 }

} elseif(isset($_POST["download"])) {

 if(!empty($_POST["input"])) {
$obj->download(str_split($_POST["input"]));
 } else {
  $obj->display_error();
 }

} else {

 $obj->print_form();
}
?>