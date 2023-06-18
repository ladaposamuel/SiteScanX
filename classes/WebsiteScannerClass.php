<?php

/**
 * Class WebsiteScannerClass - Scans a website for internal links and stores them in the database table internal_links
 * @package classes
 * @version 1.0.0
 *
 * @property string $websiteUrl
 * @property array $internalLinks
 * @property DBClass $db
 */
class WebsiteScannerClass
{

    private string $websiteUrl;
    private array $internalLinks;
    private $db;

    public function __construct(string $websiteUrl)
    {
        $this->websiteUrl = $websiteUrl;
        $this->internalLinks = [];
        $this->db = new DBClass();

    }


    /**
     *  Scan the website homepage and store the internal links in the database table internal_links, then initiate the cron job.
     * @return void
     */
    public function scanWebsite()
    {
        $this->logMessage('Scanning homepage: ' . $this->websiteUrl . "... ", 'orange');

        $html = file_get_contents($this->websiteUrl);
        libxml_use_internal_errors(true);
        $dom = new DOMDocument;
        $dom->loadHTML($html);

        $xpath = new DOMXPath($dom);
        $links = $xpath->query("//a/@href");

        foreach ($links as $link) {
            $href = $link->nodeValue;
            if ($this->isInternalLink($href)) {
                $this->internalLinks[] = $this->resolveInternalLink($href);
            }
        }
        $this->logMessage('Homepage scan completed.');
        $this->logMessage($this->getInternalLinksCount() . ' internal links found.');
        $this->storeInternalLinks();
        $this->initiateCronJob();
    }

    /**
     * Check if the link is internal
     * @param string $link
     * @return bool
     */
    private function isInternalLink(string $link): bool
    {
        $urlParts = parse_url($link);
        $host = $urlParts['host'] ?? '';

        if (empty($host) || $host === parse_url($this->websiteUrl, PHP_URL_HOST)) {
            return true;
        }

        return false;
    }

    /**
     * Resolve internal links
     * @param string $link
     * @return string
     */
    private function resolveInternalLink(string $link): string
    {
        $urlParts = parse_url($this->websiteUrl);
        $scheme = $urlParts['scheme'];
        $host = $urlParts['host'];
        $basePath = $scheme . '://' . $host;

        if (strpos($link, '/') === 0) {
            return $basePath . $link;
        }

        return $this->websiteUrl . $link;
    }

    /**
     * Print internal links
     * @return void
     */
    public function printInternalLinks()
    {
        foreach ($this->internalLinks as $link) {
            echo $link . "\n";
        }
    }


    /**
     * Get internal links count
     *
     * @return int
     */
    public function getInternalLinksCount(): int
    {
        return count($this->internalLinks);
    }

    /**
     *  Log message to the log array with a color code for the message text
     * @param $message
     * @param $color
     * @return void
     */
    private function logMessage($message, $color = 'green')
    {
        $logItem = '<span style="font-size: small; color: ' . $color . ';">' . date('Y-m-d H:i:s') . ' - ' . $message . "</span> <br>";
        $this->log[] = $logItem;
    }

    /**
     * Get Logs array
     * @return array
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * Store internal links in the database table internal_links and clear the table first
     * @return void
     */
    private function storeInternalLinks()
    {
        $clearQuery = "TRUNCATE TABLE internal_links";
        $clearStatement = $this->db->prepare($clearQuery);
        $clearStatement->execute();
        $clearStatement->close();

        $query = "INSERT INTO internal_links (url) VALUES (?)";
        $statement = $this->db->prepare($query);

        foreach ($this->internalLinks as $link) {
            $statement->bind_param('s', $link);
            $statement->execute();
        }

        $statement->close();
        $this->logMessage('Internal links stored in database.');

    }

    /**
     * Initiate the cron job to scan the internal links every hour and store the results in the database table internal_links
     * // * * * * * php -r "require_once('classes/WebsiteScannerClass.php'); $scanner = new WebsiteScanner('https://www.example.com'); $scanner->scanHomepage();" >/dev/null 2>&1
     * @return void
     */
    private function initiateCronJob()
    {
        $cronTabEntry = '* */1 * * * php -r "' . $this->getCronJobCommand() . '" >/dev/null 2>&1';

        exec('echo "' . $cronTabEntry . '" >> /tmp/cron && crontab /tmp/cron && rm /tmp/cron');
        $this->logMessage('Cron job initiated successfully with the following command: ' . $cronTabEntry, 'red');
    }

    /**
     * Get the cron job command
     * @var string $cachedCronJobCommand
     */
    private $cachedCronJobCommand;

    /**
     * Get the cron job command to scan the internal links every hour and store the results in the database table internal_links
     * @return string
     */
    private function getCronJobCommand()
    {
        if (empty($this->cachedCronJobCommand)) {
            $phpBinary = PHP_BINARY;
            $classPath = __FILE__;

            $this->cachedCronJobCommand = 'require_once("' . $classPath . '"); $scanner = new WebsiteScanner("' . $this->websiteUrl . '"); $scanner->scanHomepage();';
        }

        return $this->cachedCronJobCommand;
    }

}
