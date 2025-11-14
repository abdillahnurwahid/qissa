<?php

namespace App\Helpers;

class YouTubeHelper
{
    public static function extractVideoId($url)
    {
        if (empty($url)) {
            return null;
        }

        if (preg_match('/[?&]v=([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        if (preg_match('/embed\/([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        return null;
    }

    public static function getThumbnailUrl($videoId, $quality = 'maxresdefault')
    {
        if (empty($videoId)) {
            return null;
        }

        return "https://img.youtube.com/vi/{$videoId}/{$quality}.jpg";
    }

    public static function getEmbedUrl($videoId)
    {
        return "https://www.youtube.com/embed/{$videoId}";
    }

    public static function getWatchUrl($videoId)
    {
        return "https://www.youtube.com/watch?v={$videoId}";
    }
}