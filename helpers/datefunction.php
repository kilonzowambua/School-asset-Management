<?php
function formatDateTime($dateString) {
    // Convert the date string to a DateTime object
    $date = new DateTime($dateString);

    // Get the current date and time
    $currentDate = new DateTime();

    // Set the time of the current date to 00:00:00 for comparison
    $currentDate->setTime(0, 0, 0);

    // Set the time of the date to 00:00:00 for comparison
    $date->setTime(0, 0, 0);

    // Calculate the difference in seconds
    $interval = $currentDate->diff($date);
    $days = $interval->days;

    // Format the output based on the time difference
    if ($interval->y > 0) {
        // Format as "X years ago"
        $formattedDate = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
    } elseif ($interval->m > 0) {
        // Format as "X months ago"
        $formattedDate = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
    } elseif ($days === 1) {
        // Format as "Yesterday"
        $formattedDate = 'Yesterday';
    } elseif ($days > 1) {
        // Format as "X days ago"
        $formattedDate = $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    } elseif ($interval->h > 0) {
        // Format as "X hours ago"
        $formattedDate = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
    } elseif ($interval->i > 0) {
        // Format as "X minutes ago"
        $formattedDate = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
    } elseif ($interval->s > 0) {
        // Format as "X seconds ago"
        $formattedDate = $interval->s . ' second' . ($interval->s > 1 ? 's' : '') . ' ago';
    } else {
        // Format as "Just now"
        $formattedDate = 'Just now';
    }

    return $formattedDate;
}

