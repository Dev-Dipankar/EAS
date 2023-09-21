<?php

function fnv1_hash($data, $seed = 0x811C9DC5) {
    $hash_value = $seed;
    $data_bytes = str_split($data);
    
    foreach ($data_bytes as $byte) {
        $hash_value ^= ord($byte);
        $hash_value *= 0x01000193;
        $hash_value = $hash_value & 0xFFFFFFFF; // Limit to 32 bits (optional for 32-bit hashes)
    }
    
    return $hash_value;
}

$data = "Hello, World!";
$hash_result = fnv1_hash($data);
echo "FNV-1 Hash: " . $hash_result . "\n";

?>