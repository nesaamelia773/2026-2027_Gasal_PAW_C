<?php

// 4.1 Array height
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

// Menampilkan array height
echo 'height = (';
$pertama = true;

foreach ($height as $nama => $value) {
    if (!$pertama) {
        echo ', ';
    }

    echo '"' . $nama . '" => "' . $value . '"';
    $pertama = false;
}

echo ')<br>';

// Menampilkan seluruh data height
foreach ($height as $nama => $value) {
    echo $nama . " is " . $value . " cm tall.<br>";
}

echo "<br>";

// 4.2 Array weight
$weight = array(
    "Andy" => "70",
    "Barry" => "65",
    "Charlie" => "75"
);

// Menampilkan array weight
echo 'weight = (';
$pertama = true;

foreach ($weight as $nama => $value) {
    if (!$pertama) {
        echo ', ';
    }

    echo '"' . $nama . '" => "' . $value . '"';
    $pertama = false;
}

echo ')<br>';

// Menampilkan seluruh data weight menggunakan for
$names = array_keys($weight);

for ($i = 0; $i < count($weight); $i++) {
    $nama = $names[$i];
    echo $nama . " is " . $weight[$nama] . " kg.<br>";
}

?>