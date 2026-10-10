<?php

// 6.1 array_push()
$array = array("A");
echo 'Array awal: ("A")<br>';

array_push($array, "B");
echo 'Hasil array_push: ' . implode(", ", $array) . '<br><br>';


// 6.2 array_merge()
$array1 = array("A", "B");
$array2 = array("C");

echo 'Array awal: ("A", "B") digabung dengan ("C")<br>';

$hasil = array_merge($array1, $array2);
echo 'Hasil array_merge: ' . implode(", ", $hasil) . '<br><br>';


// 6.3 array_values()
$array = array("X" => 1, "Y" => 2);

echo 'Array awal: ("X" => 1, "Y" => 2)<br>';

$hasil = array_values($array);
echo 'Hasil array_values: ' . implode(", ", $hasil) . '<br><br>';


// 6.4 array_search()
$array = array("A", "B", "C");

echo 'Mencari "B" pada array: ("A", "B", "C")<br>';

$hasil = array_search("B", $array);
echo 'Hasil array_search: ' . $hasil . '<br><br>';


// 6.5 array_filter()
$array = array(0, 1, false, 2, "", 3, "array");

echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';

$hasil = array_filter($array);
echo 'Hasil array_filter: ' . implode(", ", $hasil) . '<br><br>';


// 6.6 Sorting array numerik
$array = array(3, 1, 2);

echo 'Array awal: (3, 1, 2)<br>';

sort($array);
echo 'Hasil sort: ' . implode(", ", $array) . '<br>';

rsort($array);
echo 'Hasil rsort: ' . implode(", ", $array) . '<br><br>';


// 6.7 Sorting array asosiatif
$nilai = array(
    "Peter" => 35,
    "Ben" => 37,
    "Joe" => 43
);

echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';

// Mengurutkan berdasarkan nilai, mempertahankan indeks
$hasil = $nilai;
asort($hasil);
echo 'Hasil asort: ';
foreach ($hasil as $nama => $angka) {
    echo $nama . '=> ' . $angka . ', ';
}
echo '<br>';

// Mengurutkan berdasarkan indeks
$hasil = $nilai;
ksort($hasil);
echo 'Hasil ksort: ';
foreach ($hasil as $nama => $angka) {
    echo $nama . '=> ' . $angka . ', ';
}
echo '<br>';

// Mengurutkan berdasarkan nilai secara menurun
$hasil = $nilai;
arsort($hasil);
echo 'Hasil arsort: ';
foreach ($hasil as $nama => $angka) {
    echo $nama . '=> ' . $angka . ', ';
}
echo '<br>';

// Mengurutkan berdasarkan indeks secara menurun
$hasil = $nilai;
krsort($hasil);
echo 'Hasil krsort: ';
foreach ($hasil as $nama => $angka) {
    echo $nama . '=> ' . $angka . ', ';
}
echo '<br>';

?>