<?php

//------------Password Generator----------------------------------------------//
$n = date('y');
$generated_password = bin2hex(random_bytes($n));

// ------- ID--------------------------------------------------------------------//
$length = date('y');
$ID = bin2hex(random_bytes($length));

// ------- Checksum--------------------------------------------------------------------//
$length = 12;
$checksum = bin2hex(random_bytes($length));

// ---System Generated Codes----------------------------------------------------------------//
$alpha = 5;
$beta = 5;
$a = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"), 1, $alpha);
$b = substr(str_shuffle("1234567890"), 1, $beta);

$alpha = 10;
$paycode = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"), 1, $alpha);

/* Staff Number */
$staff_no = 'STF-' . substr(str_shuffle("1234567890"), 1, 4);
/* Asset Tag */
$tag_no = 'asset/' . substr(str_shuffle("1234567890"), 1, 4).'/'.date('Y');





