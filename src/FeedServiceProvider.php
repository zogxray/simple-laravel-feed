<?php

namespace Zogxray\Feed;
use Illuminate\Support\ServiceProvider;

class FeedServiceProvider extends ServiceProvider
{
    public function boot(){
        $this->loadViewsFrom(__DIR__.'/views','feed');
    }
    public function register(){
        $this->app['feed'] = $this->app->share(function($app){
           return new Feed;
        });
    }
    public function provides() {
        return ['feed'];
    }
}