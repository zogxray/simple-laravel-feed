<?php
/**
 * Created by PhpStorm.
 * User: TrueRazor
 * Date: 4/7/16
 * Time: 9:11 PM
 */

namespace Zogxray\Feed;


class Item extends Feed {
    public $title;
    public $link;
    public $description;
    public $content;
    public $author = array();
    public $pubdate;
    public $enclosure = array();
    public function __construct($data)
    {
        foreach($data as $name => $value) {
            if(property_exists(get_called_class(),$name)) {
                $this->{$name} = $value;
                if($name == 'enclosure' && !empty($value) && $value !==null) {
                    $this->enclosure = ['url' => $value, 'length'=> $this->getEnclosureParam($value,'Content-Length'), 'type' => $this->getEnclosureParam($value,'Content-Type')];
                }
            }
        }
    }
    public function getEnclosureParam($url,$param){
        return get_headers($url,1)[$param];
    }
}