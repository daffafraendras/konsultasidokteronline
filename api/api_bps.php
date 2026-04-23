<?php
header('Content-Type: application/json');

$url = "https://webapi.bps.go.id/v1/api/interoperabilitas/datasource/simdasi/id/25/tahun/2025/id_tabel/TEptbDV0QlRORVl6cjl0THhMbk02Zz09/wilayah/0000000/key/8db06e1b76944a7695d9df0d7a88cc87";

$response = file_get_contents($url);

if ($response === false) {
    echo json_encode(["error" => "Gagal mengambil data"]);
    exit;
}

$data = json_decode($response, true);

$hasil = [];

foreach ($data['data'][1]['data'] as $item) {
    $wilayah = $item['label'];
    $nilai   = $item['variables']['lxkwts7rnj']['value'];

    $hasil[] = [
        "wilayah" => $wilayah,
        "nilai"   => $nilai
    ];
}

echo json_encode($hasil);
?>