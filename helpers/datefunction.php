<?php
function formatDateTime($dateString) {
    $date = new DateTime($dateString);
    $currentDate = new DateTime();
    $interval = $currentDate->diff($date);

    $years = $interval->y;
    $months = $interval->m;
    $days = $interval->d;
    $hours = $interval->h;
    $minutes = $interval->i;
    $seconds = $interval->s;

    if ($interval->invert > 1) {
        // Future dates
        if ($years > 0) {
            $formattedDate = $years . ' year' . ($years > 1 ? 's' : '') . ' later';
        } elseif ($months > 0) {
            $formattedDate = $months . ' month' . ($months > 1 ? 's' : '') . ' later';
        } elseif ($days > 0) {
            $formattedDate = $days . ' day' . ($days > 1 ? 's' : '') . ' later';
        } elseif ($hours > 0) {
            $formattedDate = $hours . ' hour' . ($hours > 1 ? 's' : '') . ' later';
        } elseif ($minutes > 0) {
            $formattedDate = $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' later';
        } elseif ($seconds > 0) {
            $formattedDate = $seconds . ' second' . ($seconds > 1 ? 's' : '') . ' later';
        } else {
            $formattedDate = 'Just now';
        }
    } else {
        // Past dates
        if ($years > 0) {
            $formattedDate = $years . ' year' . ($years > 1 ? 's' : '') . ' ago';
        } elseif ($months > 0) {
            $formattedDate = $months . ' month' . ($months > 1 ? 's' : '') . ' ago';
        } elseif ($days > 0) {
            $formattedDate = $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
        } elseif ($hours > 0) {
            $formattedDate = $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        } elseif ($minutes > 0) {
            $formattedDate = $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
        } elseif ($seconds > 0) {
            $formattedDate = $seconds . ' second' . ($seconds > 1 ? 's' : '') . ' ago';
        } else {
            $formattedDate = 'Just now';
        }
    }

    return $formattedDate;
}

