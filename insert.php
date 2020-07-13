<?php
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dropdown = $_POST['dropdown'];
$date = $_POST['date'];
if(!empty($username)|| !empty($email) ||
!empty($phone) || !empty($dropdown) || !empty($date) ){
  $host ="localhost";
  $dbUsername ="root";
  $dbPassword ="";
  $dbname ="register";

  //create fann_get_total_connections
  $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
  if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
  }else {
    $SELECT ="SELECT email FROM register Where email = ? Limit 1";
    $INSERT ="INSERT Into register(username,email,phone,dropdown,date)
    values(?,?,?,?,?,?) ";
    $stmt =$conn ->prepare($SELECT)
    $stmt->execute();
    $stmt->store_result();
    $rnum =$stmt->num_rows;
    if ($rnum==0) {
      $stmt->close();

      $stmt =$conn->prepare($INSERT);
      $stmt->bind_param("ssisd",$username,$email,$phone,$dropdown,$date);
      $stmt->execute();
      echo"New Record inserted succesfully";
    }
      $stmt->close();
      $conn->close();
  }

}else {
  echo "All field are Required";
  die();
}

?>
