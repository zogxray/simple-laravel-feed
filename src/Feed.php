<?php

namespace Zogxray\Feed;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

class Feed {

    public $channel;
    public $items = array();
    private $content_type;

    public function render($format = 'atom', $cache = FALSE, $cacheTime = 3600){
        $channel = $this->channel;
        $channel->pubdate = $this->formatDate($this->channel->pubdate,$format);
        $items = $this->items;
        foreach($items as $item) {
            $item->pubdate =  $this->formatDate($item->pubdate,$format);
        }
        if($format == 'atom') {
            $this->ctype = 'application/atom+xml';
        } else {
            $this->ctype = 'application/rss+xml';
        }
        if($cache == TRUE && Cache::has('feed-'.$format)) {
            return response()->view('feed::'.$format,Cache::get('feed-'.$format))->header('Content-Type',$this->content_type)->header('Content-Type','text/xml');
        } elseif($cache == TRUE) {
            Cache::put('feed-'.$format,compact('channel','items'),$cacheTime);
            return response()->view('feed::'.$format,compact('channel','items'))->header('Content-Type',$this->content_type)->header('Content-Type','text/xml');
        } elseif($cache == FALSE && Cache::has('feed-'.$format)) {
            Cache::forget('feed-'.$format);
            return response()->view('feed::'.$format,compact('channel','items'))->header('Content-Type',$this->content_type)->header('Content-Type','text/xml');
        } else {
            return response()->view('feed::'.$format,compact('channel','items'))->header('Content-Type',$this->content_type)->header('Content-Type','text/xml');
        }
    }
    public function setChannel($data)
    {
       $this->channel = new Channel($data);
    }
    public function addItem($item){
        $this->items[] = new Item($item);
    }
    protected function formatDate($date, $format='atom')
    {
        if ($format == "atom")
        {
            $date = date('c', strtotime($date));
        }
        else
        {
            $date = date('D, d M Y H:i:s O', strtotime($date));
        }
        return $date;
    }
    public function getPubdate() {
        return date('D, d M Y H:i:s O');
    }
    public function getLang() {
        return Config::get('app.locale');
    }
    public function getURL() {
        return Request::url();
    }
}