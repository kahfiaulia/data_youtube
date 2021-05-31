<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_channel_model extends MY_Model
{
    function __construct() 
    {
        parent::__construct();
    }

    public function get_curl($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
    
        return json_decode($result, true);
    }

    $result = get_curl('https://www.googleapis.com/youtube/v3/channels?part=snippet,contentDetails,statistics&id=UCrDpcBofGGMLsAmxtjZBHlQ&key=AIzaSyB5CexAxWjzUn8c0g-iQheIRkKB6zreFjQ');
    
    $id = $result['items'][0]['id'];
    $nama= $result['items'][0]['snippet']['title'];
    $fotoProfil = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
    $deskripsi = $result['items'][0]['snippet']['description'];
    $tanggalPembuatan = $result['items'][0]['snippet']['publishedAt'];
    $jumlahView = $result['items'][0]['statistics']['viewCount'];
    $jumlahSubscriber = $result['items'][0]['statistics']['subscriberCount'];
    $jumlahVideo = $result['items'][0]['statistics']['videoCount'];
}
