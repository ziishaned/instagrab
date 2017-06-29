<?php

namespace Zeeshan\Instagrab;

use Exception;
use DOMDocument;

/**
 * Download photos and videos directly from instagram.
 *
 * @author    Zeeshan Ahmed <ziishaned@gmail.com>
 * @copyright 2017 Zeeshan Ahmed
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class Grabber
{
    
    /**
     * A link from where user wants to download the image or video.
     *
     * @var string
     */
    protected $url;

    /**
     * Link to download the media file.
     *
     * @var string
     */
    protected $fileUrl;

    /**
     * Meta tags that are avaliable in instagram link.
     *
     * @var array
     */
    protected $metaTags = [];

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        if (!$this->validateUrl($url)) {
            throw new Exception("Url is not valid.");
        }

        $this->url = $url;
        
        $this->getFile();

        $this->setFileUrl();
    }

    /**
     * Read the url value.
     *
     * @return string
     */
    public function getUrl() : string
    {
        return $this->url;
    }

    /**
     * Get the html from the instagram link.
     *
     * @return void
     */
    public function getFile()
    {
        $response = file_get_contents($this->url);

        $this->setMetaTags($response);
    }

    /**
     * Set the url from where media file will be downloaded.
     */
    public function setFileUrl() : Grabber
    {
        if (array_key_exists('og:image', $this->metaTags)) {
            $this->fileUrl = $this->metaTags['og:image'];
            return $this;
        }

        $this->fileUrl = $this->metaTags['og:video'];
        return $this;
    }

    /**
     * Get the download media file url.
     *
     * @return string
     */
    public function getFileUrl() : string
    {
        return $this->fileUrl;
    }

    /**
     * @param string $html
     */
    public function setMetaTags($html) : Grabber
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);

        foreach ($dom->getElementsByTagName('meta') as $meta) {
            $this->metaTags[$meta->getAttribute('property')] = $meta->getAttribute('content');
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getMetaTags() : array
    {
        return $this->metaTags;
    }

    /**
     * @return string
     */
    public function getDownloadUrl() : string
    {
        return $this->fileUrl;
    }

    public function download(string $path) 
    {
        if (!is_dir($path) || !is_writable($path)) {
            throw new Exception('Given path does not exist or is not writable');
        }

        $fileName = basename($this->fileUrl);

        $path = rtrim($path, '') . '/' . $fileName;

        file_put_contents($path, file_get_contents($this->fileUrl));
    }

    /**
     * Validate the url provided by the user.
     *
     * @param  string $url
     * @return bool
     */
    private function validateUrl(string $url) : bool
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }
        return true;
    }
}
