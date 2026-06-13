<?php
// Test loremflickr for getting relevant product images
$keywords = [
    'gaming laptop',
    'smartphone',
    'iphone',
    'macbook',
];
foreach ($keywords as $kw) {
    $url = 'https://loremflickr.com/400/400/' . urlencode($kw);
    $ctx = stream_context_create(['http' => ['header' => "User-Agent: Mozilla/5.0\r\n", 'timeout' => 10]]);
    $img = @file_get_contents($url, false, $ctx);
    if ($img !== false && strlen($img) > 1000) {
        echo "$kw: OK (" . strlen($img) . " bytes)\n";
        file_put_contents(__DIR__ . "/test_$kw.jpg", $img);
    } else {
        echo "$kw: FAIL\n";
    }
}
