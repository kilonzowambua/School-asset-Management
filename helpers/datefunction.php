<?php
function formatDateTime($dateString) {
    // Convert the date string to a DateTime object
    $date = new DateTime($dateString);

    // Get the current date and time
    $currentDate = new DateTime();

    // Calculate the difference in days
    $interval = $currentDate->diff($date);
    $days = $interval->days;

    // Format the output based on the time difference
    if ($days === 1 && $interval->invert === 0) {
        // Format as "Yesterday"
        $formattedDate = 'Yesterday';
    } elseif ($days > 1 && $days < 7 && $interval->invert === 0) {
        // Format as "X days ago"
        $formattedDate = $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    } elseif ($interval->invert === 0) {
        // Format as "X days ago" (if more than 6 days)
        $formattedDate = floor($days / 7) . ' week' . (floor($days / 7) > 1 ? 's' : '') . ' ago';
    } else {
        // Format as "Just now" if the date is in the future
        $formattedDate = 'Just now';
    }

    return $formattedDate;
}
