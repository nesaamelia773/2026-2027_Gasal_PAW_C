<?php

// 3.1 Menambahkan lima data
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

echo 'height = (';
$pertama = true;

foreach ($height as $name => $value) {
    if (!$pertama) {
        echo ', ';
    }

    echo '"' . $name . '" => "' . $value . '"';
    $pertama = false;
}

echo ')<br>';
echo "Nilai dengan indeks terakhir: " . end($height);
echo "<br><br>";

// Menghapus data Barry
unset($height["Barry"]);

echo "Data Barry dihapus.<br>";

echo 'height = (';
$pertama = true;

foreach ($height as $name => $value) {
    if (!$pertama) {
        echo ', ';
    }

    echo '"' . $name . '" => "' . $value . '"';
    $pertama = false;
}

echo ')<br>';
echo "Nilai dengan indeks terakhir: " . end($height);
echo "<br><br>";

// Membuat array weight
$weight = array(
    "Andy" => "70",
    "Barry" => "65",
    "Charlie" => "75"
);

// Menampilkan isi array weight
echo 'weight = (';
$pertama = true;

foreach ($weight as $name => $value) {
    if (!$pertama) {
        echo ', ';
    }

    echo '"' . $name . '" => "' . $value . '"';
    $pertama = false;
}

echo ')<br>';

// Menampilkan data kedua
echo "Data kedua: " . $weight["Barry"];

?>