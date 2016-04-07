# Simple generate RSS and ATOM feeds


## Install

Install the package:

``` bash
$ composer require zogxray/simple-laravel-feed
```

Register service provider in config/app.php

```php
'providers' => [
    ...
    Zogxray\Feed\FeedServiceProvider::class,

];
```

Enjoy!


```php
Route::get('feed/{format}', function ($format) {
    $posts = [
        "0" => [
            'title' => 'Post 1',
            'link' => 'http://package.dev/post/1',
            'description' => 'Post 1 description',
            'author' => ['email' =>'zoxray@gmail.com','name' => 'Viktor Pavlov','url'=>url('/')],
            'image' => 'http://pavlov.od.ua/images/posts/post-e7d628ade3e3bb1caad4d1c5f95b2090.jpg',
            'pubdate' => date('D, d M Y H:i:s O')
        ],
        "1" => [
            'title' => 'Post 2',
            'link' => 'http://package.dev/post/2',
            'description' => 'Post 2 description',
            'author' => ['email' =>'zoxray@gmail.com','name' => 'Viktor Pavlov','url'=>url('/')],
            'image' => 'http://pavlov.od.ua/images/posts/post-e7d628ade3e3bb1caad4d1c5f95b2090.jpg',
            'pubdate' => date('D, d M Y H:i:s O',strtotime("-30 days"))
        ],
    ];
    $feed = App::make('feed');
    $feed->setChannel([
        'title' =>'News',
        'lang' => $feed->getLang(),
        'description' => 'Laravel',
        'link' => $feed->getURL(),
        'logo' => 'http://package.dev/logo.png',
        'icon' => 'http://package.dev/favicon.ico',
        'pubdate' => $feed->getPubdate()
    ]);
    foreach ($posts as $post) {
        $feed->addItem([
            'title' => $post['title'],
            'link' => $post['link'],
            'description' => $post['description'],
            'author' => $post['author'],
            'enclosure' => $post['image'],
            'pubdate' => $post['pubdate'],
        ]);
    }
    return $feed->render($format);
});
```

Cache

```php
return $feed->render($format,TRUE,3600);
];
```

