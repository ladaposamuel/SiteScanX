<?php

class WebsiteScanner {
    private $homepageUrl;
    private $internalLinks;

    public function __construct($homepageUrl) {
        $this->homepageUrl = $homepageUrl;
        $this->internalLinks = array();
    }

    public function scanHomepage() {
        $html = file_get_contents($this->homepageUrl);
        $dom = new DOMDocument;
        @$dom->loadHTML($html);

        $links = $dom->getElementsByTagName('a');

        foreach ($links as $link) {
            $href = $link->getAttribute('href');
            if ($this->isInternalLink($href)) {
                $this->internalLinks[] = $this->resolveInternalLink($href);
            }
        }
    }

    private function isInternalLink($link) {
        $urlParts = parse_url($link);
        $host = $urlParts['host'] ?? [];

        if (empty($host) || $host === parse_url($this->homepageUrl, PHP_URL_HOST)) {
            return true;
        }

        return false;
    }

    private function resolveInternalLink($link) {
        $urlParts = parse_url($this->homepageUrl);
        $scheme = $urlParts['scheme'];
        $host = $urlParts['host'];
        $basePath = $scheme . '://' . $host;

        if (strpos($link, '/') === 0) {
            return $basePath . $link;
        }

        return $this->homepageUrl . $link;
    }

    public function printInternalLinks() {
        foreach ($this->internalLinks as $link) {
            echo $link . "\n";
        }
    }

    public function getInternalLinksCount() {
        return count($this->internalLinks);
    }
}


?>
