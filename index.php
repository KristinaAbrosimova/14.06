<!DOCTYPE html>
<html lang="en">
<head>
	<title>студент</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->
</head>
<body>

<form name="ochen" method="POST">

  <label for="name_s">ФИО студента:</label>
  <input type="text" id="name_s" name="name_s">
  <button type="submit" name="form">Найти</button>
</form>
</div>
	
</body>
</html>

<?php 

include_once("config.php");
include_once("db_connect.php");

if (isset($_POST['name_s']) ) {
    $lastname = $_POST['name_s'];
    $stmt = mysqli_prepare($connection, "SELECT name_s, predmet, ochanka AS P_Yspev
    FROM P_Yspev
    INNER JOIN P_Student ON P_Yspev.id_stud = P_Student.id
    WHERE name_s = ?
    GROUP BY name_s, predmet");
    mysqli_stmt_bind_param($stmt, "s", $lastname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr><th>ФИО</th><th>Дисциплина</th><th>Оценка</th></tr>';
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['name_s']) . '</td>';
            echo '<td>' . htmlspecialchars($row['predmet']) . '</td>';
            echo '<td>' . htmlspecialchars($row['P_Yspev']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "<table>";
        echo "<tr><td>Студент не найден.</td></tr>";
        echo "</table>";
    }
}
?>
