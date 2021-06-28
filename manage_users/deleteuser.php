<?php
// Połączenie z bazą danych //
include "db_Con.php";

// Przypisane zmiennej 'id' //
$id = $_GET['id'];

// Zapytanie usunięcia danego rzędu z bazy danych o danym id //
$query_delete = "DELETE from uzytkownicy WHERE id = '$id'";
$delete = mysqli_query($con, $query_delete);

// Wyświetlanie alert() w przypadku powodzenia / niepowodzenia oraz przekierowanie na stronę główną //
if($delete) {
  ?>
  <script type="text/javascript"> 
  alert("Pomyślnie usunięto użytkownika z bazy danych"); 
  window.location.href = "index.php";
  </script>;
  <?php
  exit;	
} else {
  ?>
  <script type="text/javascript"> 
  alert("Nie udało się usunąć użytkownika z bazy danych!"); 
  window.location.href = "index.php";
  </script>;
  <?php
}
?>