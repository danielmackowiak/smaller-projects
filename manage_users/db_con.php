<?php
// Połączenie z bazą danych, pokazanie błędu w przypadku braku połączenia //
$con = mysqli_connect("localhost","root","","db-bank");
mysqli_set_charset($con, 'utf8');
if (mysqli_connect_errno()){
echo "Błąd połączenia z bazą MySQL: " . mysqli_connect_error();
}
?>