<?php

function sha256($message) {
    // Initial hash values (first 32 bits of the fractional parts of the square roots of the first 8 prime numbers)
    $h = [
        0x6a09e667, 0xbb67ae85, 0x3c6ef372, 0xa54ff53a,
        0x510e527f, 0x9b05688c, 0x1f83d9ab, 0x5be0cd19
    ];
    
    // Pre-defined constants (first 32 bits of the fractional parts of the cube roots of the first 64 prime numbers)
    $K = [
        0x428a2f98, 0x71374491, 0xb5c0fbcf, 0xe9b5dba5,
        // ... (constants for rounds 0-63)
    ];
    
    // Initialize message schedule
    $W = array_fill(0, 64, 0);
    
    // Pad the message
    $message = utf8_encode($message);
    $ml = strlen($message) * 8;  // Message length in bits
    $message .= "\x80";
    while ((strlen($message) * 8) % 512 != 448) {
        $message .= "\x00";
    }
    $message .= pack("J", $ml); // Append the message length in bits
    
    // Process the message in 512-bit blocks
    $blocks = str_split($message, 64);
    foreach ($blocks as $block) {
        $blockInts = array_values(unpack("N16", $block)); // Split block into 16 32-bit integers
        
        // Prepare message schedule
        for ($t = 0; $t < 16; $t++) {
            $W[$t] = $blockInts[$t];
        }
        
        // Extend the message schedule
        for ($t = 16; $t < 64; $t++) {
            $s0 = ($W[$t-15] >> 7 | $W[$t-15] << 25) ^ ($W[$t-15] >> 18 | $W[$t-15] << 14) ^ ($W[$t-15] >> 3);
            $s1 = ($W[$t-2] >> 17 | $W[$t-2] << 15) ^ ($W[$t-2] >> 19 | $W[$t-2] << 13) ^ ($W[$t-2] >> 10);
            $W[$t] = ($W[$t-16] + $s0 + $W[$t-7] + $s1) & 0xFFFFFFFF;
        }
        
        // Initialize working variables
        list($a, $b, $c, $d, $e, $f, $g, $h) = $h;
        
        // Main loop
        for ($t = 0; $t < 64; $t++) {
            $S1 = ($e >> 6 | $e << 26) ^ ($e >> 11 | $e << 21) ^ ($e >> 25 | $e << 7);
            $ch = ($e & $f) ^ (~$e & $g);
            $temp1 = ($h + $S1 + $ch + $K[$t] + $W[$t]) & 0xFFFFFFFF;
            $S0 = ($a >> 2 | $a << 30) ^ ($a >> 13 | $a << 19) ^ ($a >> 22 | $a << 10);
            $maj = ($a & $b) ^ ($a & $c) ^ ($b & $c);
            $temp2 = ($S0 + $maj) & 0xFFFFFFFF;
            
            $h = $g;
            $g = $f;
            $f = $e;
            $e = ($d + $temp1) & 0xFFFFFFFF;
            $d = $c;
            $c = $b;
            $b = $a;
            $a = ($temp1 + $temp2) & 0xFFFFFFFF;
        }
        
        // Update hash values
        $h = [
            ($h[0] + $a) & 0xFFFFFFFF,
            ($h[1] + $b) & 0xFFFFFFFF,
            ($h[2] + $c) & 0xFFFFFFFF,
            ($h[3] + $d) & 0xFFFFFFFF,
            ($h[4] + $e) & 0xFFFFFFFF,
            ($h[5] + $f) & 0xFFFFFFFF,
            ($h[6] + $g) & 0xFFFFFFFF,
            ($h[7] + $h) & 0xFFFFFFFF
        ];
    }
    
    // Produce the final hash value
    $hashValue = sprintf("%08x%08x%08x%08x%08x%08x%08x%08x", ...$h);
    return $hashValue;
}

// Test the function
$message = "Hello, SHA-256!";
$hashed = sha256($message);
echo "Message: $message\n";
echo "SHA-256 Hash: $hashed\n";

?>
