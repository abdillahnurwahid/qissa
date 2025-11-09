<?php

namespace App\Helpers;

class YouTubeHelper
{
    /**
     * Extract YouTube video ID from URL
     * Supports: youtube.com/watch?v=, youtu.be/, youtube.com/embed/
     */
    public static function extractVideoId($url)
    {
        if (empty($url)) {
            return null;
        }

        // Pattern 1: youtube.com/watch?v=XXXXXXXXXXX
        if (preg_match('/[?&]v=([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        // Pattern 2: youtu.be/XXXXXXXXXXX
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        // Pattern 3: youtube.com/embed/XXXXXXXXXXX
        if (preg_match('/embed\/([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        // Pattern 4: Already 11 characters (direct ID)
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        return null;
    }

    /**
     * Get YouTube thumbnail URL from video ID
     */
    public static function getThumbnailUrl($videoId, $quality = 'maxresdefault')
    {
        if (empty($videoId)) {
            return null;
        }

        // Quality options: maxresdefault, hqdefault, mqdefault, sddefault
        return "https://img.youtube.com/vi/{$videoId}/{$quality}.jpg";
    }

    /**
     * Get YouTube embed URL
     */
    public static function getEmbedUrl($videoId)
    {
        return "https://www.youtube.com/embed/{$videoId}";
    }

    /**
     * Get YouTube watch URL
     */
    public static function getWatchUrl($videoId)
    {
        return "https://www.youtube.com/watch?v={$videoId}";
    }
}