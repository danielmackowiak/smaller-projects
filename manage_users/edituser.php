<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./style.css">
    <script src="https://kit.fontawesome.com/dd0991aa14.js" crossorigin="anonymous"></script>
</head>
<body>

<?php
// Połączenie z bazą danych //
include "db_Con.php";

// Przypisane zmiennej 'id' //
$id = $_GET['id'];

// Po kliknięciu guzika zaktualizuje dane użytkownika //
if(isset($_POST['update']))
{
  // Przypisanie zmiennych dla wszystkich danych z formularza //
  $imie = $_POST['imie'];
  $nazwisko = $_POST['nazwisko'];
  $email = $_POST['email'];
  $numer_telefonu = $_POST['numer_telefonu'];
  $ulica = $_POST['ulica'];
  $miasto = $_POST['miasto'];
  $kod_pocztowy = $_POST['kod_pocztowy'];

  // Zaktualizowanie danych użytkownika w bazie danych //
  $query_update_user = "UPDATE uzytkownicy SET imie = '$imie', nazwisko = '$nazwisko', email = '$email', numer_telefonu = '$numer_telefonu', ulica = '$ulica', miasto = '$miasto', kod_pocztowy = '$kod_pocztowy' WHERE id = '$id'";
  $update = mysqli_query($con, $query_update_user);

  // Wyświetlanie alert() w przypadku powodzenia / niepowodzenia oraz przekierowanie na stronę główną //
  if($update) {
    ?>
    <script type="text/javascript"> 
    alert("Pomyślnie zakutalizowano użytkownika w bazie danych"); 
    window.location.href = "index.php";
    </script>;
    <?php
    exit;
  } else {
    ?>
    <script type="text/javascript"> 
    alert("Nie udało się zaktualizować użytkownika w bazie danych!"); 
    window.location.href = "index.php";
    </script>;
    <?php
  }    	
}
// Zapytanie o dany rzęd z bazy danych o danym id, oraz ściąganie danych z bazy danych //
$query_edit_form = "SELECT id, imie, nazwisko, email, numer_telefonu, ulica, miasto, kod_pocztowy FROM uzytkownicy WHERE id='$id'";
$data = mysqli_query($con, $query_edit_form);
while($row = mysqli_fetch_assoc($data)) {
?>
<div class="form_users">
   <!-- Formularz edytowania użytkowników w bazie danych -->
  <form class="form" action="" method="post">
        <h1>Zaktualizuj dane użytkownika</h1>
  <label for="imie">Imię: </label>
      <input required class="form_input" type="text" name="imie" placeholder="Imię" value="<?php echo $row['imie'];?>">
  <label for="nazwisko">Nazwisko: </label>
      <input required class="form_input" type="text" name="nazwisko" placeholder="Nazwisko" value="<?php echo $row['nazwisko'];?>"><br>
  <label for="email">Adres e-mail: </label>
      <input required class="form_input" type="text" name="email" placeholder="e-mail" value="<?php echo $row['email'];?>">
  <label for="numer_telefonu">Numer Telefonu: </label>
      <input required class="form_input" type="number" name="numer_telefonu" maxlength="9" placeholder="Numer telefonu" value="<?php echo $row['numer_telefonu'];?>"><br>
  <label for="ulica">Ulica: </label>
      <input required class="form_input" type="text" name="ulica" placeholder="Ulica" value="<?php echo $row['ulica'];?>">
  <label for="Miasto">Miasto: </label>
      <input required class="form_input" type="text" name="miasto" placeholder="Miasto" value="<?php echo $row['miasto'];?>">
  <label for="kod_pocztowy">Kod pocztowy: </label>
      <input required class="form_input" type="text" name="kod_pocztowy" maxlength="6" width="100px" placeholder="Kod pocztowy" value="<?php echo $row['kod_pocztowy'];?>"><br>
      <button class="form_submit" type="submit" name="update" value="update">Zaktualizuj użytkownika</button>
  </form>
</div>

<!-- Tabela wyświetaląca wszystkich userów w bazie danych -->
<div class="allusers_table">
    <form class="form_table" action="" method="post">
        <table>
            <!-- Nagłówek tabeli -->
          <thead> 
            <tr>
                <th>Imię i nazwisko</th>
                <th>Adres e-mail</th>
                <th>Numer telefonu</th>
                <th>Ulica</th>
                <th>Miasto</th>
                <th>Kod pocztowy</th>
                <th>Usuń</th>
                <th>Edytuj</th>
            </tr>
          </thead>
            <?php
            // Wybieranie danych z tabeli w bazie danych //
            $query_table = "SELECT id, imie, nazwisko, email, numer_telefonu, ulica, miasto, kod_pocztowy FROM uzytkownicy";
            $result = mysqli_query($con, $query_table);
            // Tworzenie tabeli //
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $imie_nazwisko = $row["imie"].$row["nazwisko"];
                    echo "<tr><td>" . $row["imie"] . " " . $row["nazwisko"] . "</td><td>" . $row["email"] . "</td><td>" . $row["numer_telefonu"] . "</td><td>" . $row["ulica"] . "</td><td>" . $row["miasto"] . "</td><td>" . $row["kod_pocztowy"] . "</td>" ?><td><a href="./deleteuser.php?id=<?php echo $row['id']?>;" onclick="return confirm('Napewno chcesz usunąć tego użytkownika?')" class="a_delete"><i class="fas fa-trash-alt"></i></a></td><td><a href="./edituser.php?id=<?php echo $row['id'];?>" class="a_edit"><i class="fas fa-edit"></i></a> <?php "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<h2>Brak użytkowników</h2>";
            }
            ?>
        </table>
    </form>
</div>
<?php
}
?>
<footer>Kiedyś coś tu będzie</footer>
</body>
</html>