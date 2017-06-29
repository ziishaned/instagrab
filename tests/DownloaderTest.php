<?php

namespace Tests;

use Exception;
use Zeeshan\Instagrab\Downloader;

class DownloaderTest extends \PHPUnit_Framework_TestCase
{
    public function testDownloaderMustThrowExceptionForNotAValidURL()
    {
        try {
            $downloader = new Downloader('not_a_valid_url');
        } catch (Exception $e) {
            $this->assertEquals($e->getMessage(), "Url is not valid.");
        }
    }

    public function testDownloaderMustAcceptAValidURL()
    {
        $url = 'https://www.instagram.com/p/BUZLoGyFXQX';

        $downloader = new Downloader($url);
        
        $this->assertEquals($downloader->getUrl(), $url);
    }

    public function testGetUrlMustReturnProvidedUrl()
    {
        $url = 'https://www.instagram.com/p/BUZLoGyFXQX';

        $downloader = new Downloader($url);

        $this->assertEquals($url, $downloader->getUrl());
    }

    public function testGetDownloadUrlMustReturnAUrlToDownloadMediaFile()
    {
        $url = 'https://www.instagram.com/p/BUZLoGyFXQX';

        $downloader = new Downloader($url);

        $this->assertEquals(gettype($downloader->getDownloadUrl()), 'string');
    }
}
