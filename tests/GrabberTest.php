<?php

namespace Tests;

use Exception;
use Zeeshan\Instagrab\Grabber;

class GrabberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedExceptionMesage "Url is not valid."
     */
    public function testGrabberMustThrowExceptionForNotAValidURL()
    {
        $grabber = new Grabber('not_a_valid_url');
    }

    public function testGrabberMustAcceptAValidURL()
    {
        $url = 'https://www.instagram.com/p/BUZLoGyFXQX';

        $grabber = new Grabber($url);
        
        $this->assertEquals($grabber->getUrl(), $url);
    }

    public function testGetUrlMustReturnProvidedUrl()
    {
        $url = 'https://www.instagram.com/p/BUZLoGyFXQX';

        $grabber = new Grabber($url);

        $this->assertEquals($url, $grabber->getUrl());
    }

    public function testGetDownloadUrlMustReturnAUrlToDownloadMediaFile()
    {
        $url = 'https://www.instagram.com/p/BUZLoGyFXQX';

        $grabber = new Grabber($url);

        $this->assertEquals(gettype($grabber->getDownloadUrl()), 'string');
    }
}
