<?php

function formatDateTime($dateString) {
    // Convert the input date string to a DateTime object
    $date = new DateTime($dateString);
    
    // Format the date as "dd/mm/yy"
    $formattedDate = $date->format('d/m/Y');
    
    return $formattedDate;
}