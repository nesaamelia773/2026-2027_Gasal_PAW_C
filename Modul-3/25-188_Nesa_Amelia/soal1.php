<?php
// 1.1 Menambahkan lima data
$fruits = array("Avocado", "Blueberry", "Cherry");

$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

// Menampilkan array 1.1
echo "fruits = (";
foreach ($fruits as $key => $fruit) {
    echo '"' . $fruit . '"';
    if ($key < count($fruits) - 1) {
        echo ", ";
    }
}
echo ")<br>";
echo "Nilai dengan indeks tertinggi: " . $fruits[count($fruits) - 1];

echo "<br><br>";

// 1.2 Menghapus Blueberry
unset($fruits[1]);
$fruits = array_values($fruits);

// Menampilkan array 1.2
echo "Data Blueberry dihapus.<br>";
echo "fruits = (";
foreach ($fruits as $key => $fruit) {
    echo '"' . $fruit . '"';
    if ($key < count($fruits) - 1) {
        echo ", ";
    }
}
echo ")<br>";
echo "Nilai dengan indeks tertinggi: " . $fruits[count($fruits) - 1];
?>