<?php


function getBaseUrl()
{
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST'];

    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';

    return $protocol.'://'.$hostName;
}

function cleanString($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getPrevScan($count = true) {
    $db = new DBClass();
    $query = "SELECT " . ($count ? "COUNT(*)" : "*") . " FROM internal_links";
    $stmt = $db->prepare($query);
    if(!$count) {
        $stmt->execute();
        $resultSet = $stmt->get_result();
        return $resultSet->fetch_all(MYSQLI_ASSOC);
    } else {
        $stmt->execute();
        $result = $stmt->fetch_row();
        return $result[0];
    }
}

function checkSiteMapfile() {
    $sitemapFilePath = $_SERVER['DOCUMENT_ROOT'] . '/public/sitemap.html';
    if(file_exists($sitemapFilePath)) {
        return true;
    } else {
        return false;
    }
}

