![Instagrab](http://i.imgur.com/v0ENwXW.png)
> Instagrab - Easily grab or download Instagram content 

# Installation
```bash
$ composer require zeeshan/instagrab
```

# Usage

Create a grabber object while passing the instagram page URL

```php
use Zeeshan\Instagrab\Grabber;

$grabber = new Grabber('https://www.instagram.com/p/BUZLoGyFXQX');
```
Now download the media file
```php
$grabber->download();
```
Or get the download URL
```php
echo $grabber->getDownloadUrl(); // https://instagram.flhe1-1.fna.fbcdn.net/t51.288...
```

# Contributing
Feel free to open pull requests or submit any issues with bugs or feature requests.

# License
MIT © Zeeshan Ahmed