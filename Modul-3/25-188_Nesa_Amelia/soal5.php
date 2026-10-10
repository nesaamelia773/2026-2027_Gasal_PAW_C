<?php

// 5.1 Membuat array multidimensi
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

// Menampilkan data awal
echo "Data awal:<br>";
echo "students = (<br>";
$count = count($students);
foreach ($students as $index => $student) {
    echo '("' . $student[0] . '", "' . $student[1] . '", "' . $student[2] . '")';
    if ($index < $count - 1) {
        echo ",<br>";
    } else {
        echo "<br>";
    }
}
echo ")<br><br>";

// Menambahkan lima data baru
$students[] = array("Daniel", "220404", "0812345611");
$students[] = array("Elena", "220405", "0812345622");
$students[] = array("Fiona", "220406", "0812345633");
$students[] = array("Gabe", "220407", "0812345644");
$students[] = array("Hannah", "220408", "0812345655");

// Menampilkan data setelah ditambah lima data
echo "Data setelah ditambah 5 data lain:<br>";
echo "students = (<br>";
$count = count($students);
foreach ($students as $index => $student) {
    echo '("' . $student[0] . '", "' . $student[1] . '", "' . $student[2] . '")';
    if ($index < $count - 1) {
        echo ",<br>";
    } else {
        echo "<br>";
    }
}
echo ")<br><br>";

// Menampilkan seluruh data dalam bentuk tabel
echo '<table border="1" cellspacing="0" cellpadding="4">';
echo "<tr>";
echo "<th>Name</th>";
echo "<th>NIM</th>";
echo "<th>Mobile</th>";
echo "</tr>";

foreach ($students as $student) {
    echo "<tr>";
    echo "<td>" . $student[0] . "</td>";
    echo "<td>" . $student[1] . "</td>";
    echo "<td>" . $student[2] . "</td>";
    echo "</tr>";
}

echo "</table>";

?>