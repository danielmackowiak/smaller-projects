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
// Połączenie z bazą danych, pokazanie błędu w przypadku braku połączenia //
include "db_con.php";

    // Sprawdzenie czy pola zostały wypełnione, aby dodać nowe dany do bazy danych //
    if (isset($_REQUEST['imie'])) {

        // Zmiana wszystkich danych wypełnionych w formularzu na zmienne //
        $imie = stripslashes($_REQUEST['imie']);
        $imie = mysqli_real_escape_string($con, $imie);

        $nazwisko = stripslashes($_REQUEST['nazwisko']);
        $nazwisko = mysqli_real_escape_string($con, $nazwisko);

        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($con, $email);

        $numer_telefonu = stripslashes($_REQUEST['numer_telefonu']);
        $numer_telefonu = mysqli_real_escape_string($con, $numer_telefonu);

        $ulica = stripslashes($_REQUEST['ulica']);
        $ulica = mysqli_real_escape_string($con, $ulica);

        $miasto = stripslashes($_REQUEST['miasto']);
        $miasto = mysqli_real_escape_string($con, $miasto);

        $kod_pocztowy = stripslashes($_REQUEST['kod_pocztowy']);
        $kod_pocztowy = mysqli_real_escape_string($con, $kod_pocztowy);

        // Dodawanie zmiennych do bazy danych //
        $query = "INSERT into `uzytkownicy` (imie, nazwisko, email, numer_telefonu, ulica, miasto, kod_pocztowy)
                     VALUES ('$imie', '$nazwisko', '$email', '$numer_telefonu', '$ulica',  '$miasto', '$kod_pocztowy')";
        $result = mysqli_query($con, $query);

        if ($result) {
            ?>
                <script type="text/javascript"> 
                alert("Pomyślnie dodano użytkownika"); 
                window.location.href = "index.php";
                </script>;
            <?php
        } else {
            ?>
                <script type="text/javascript"> 
                alert("Proszę wypełnić wszystkie pola!"); 
                window.location.href = "index.php";
                </script>;
            <?php
        }

    } else {
?>
<div class="form_users">
    <!-- Formularz dodawania użytkownika do bazy danych -->
    <form class="form" action="" method="post">
         <h1>Dodawanie oraz usuwanie użytkowników</h1>
    <label for="imie">Imię: </label>
        <input required class="form_input" type="text" name="imie" placeholder="Imię">
    <label for="nazwisko">Nazwisko: </label>
        <input required class="form_input" type="text" name="nazwisko" placeholder="Nazwisko"><br>
    <label for="email">Adres e-mail: </label>
        <input required class="form_input" type="text" name="email" placeholder="e-mail">
    <label for="numer_telefonu">Numer Telefonu: </label>
        <input required class="form_input" type="number" name="numer_telefonu" min="000000001" max="999999999" placeholder="Numer telefonu"><br>
    <label for="ulica">Ulica: </label>
        <input required class="form_input" type="text" name="ulica" placeholder="Ulica">
    <label for="Miasto">Miasto: </label>
        <input required class="form_input" type="text" name="miasto" placeholder="Miasto">
    <label for="kod_pocztowy">Kod pocztowy: </label>
        <input required class="form_input" type="text" name="kod_pocztowy" maxlength="6" width="100px" placeholder="Kod pocztowy"><br>
        <button class="form_submit" type="submit" name="submit" value="submit">Dodaj użytkownika</button>
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