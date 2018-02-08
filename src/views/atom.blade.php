{!! '<'.'?'.'xml version="1.0" encoding="UTF-8" ?>' !!}
<feed xmlns="http://www.w3.org/2005/Atom">
    <title type="text">{!! $channel->title !!}</title>
    <subtitle type="html"><![CDATA[{!!$channel->description!!}]]></subtitle>
    <link href="{{$channel->link}}"></link>
    <id>{{$channel->link}}</id>
    <link rel="alternate" type="text/html" href="{{$channel->link}}"></link>
    <link rel="self" type="application/atom+xml" href="{{$channel->link}}"></link>
    @if (!empty($channel->logo))
        <logo>{{$channel->logo}}</logo>
    @endif
    @if (!empty($channel->icon))
        <icon>{{$channel->icon}}</icon>
    @endif
    <updated>{{$channel->pubdate}}</updated>
    @foreach($items as $item)
        <entry>
            <author>
                <name>{!! $item->author['name'] !!}</name>
                <uri>{{$item->author['url']}}</uri>
                <email>{{$item->author['email']}}</email>
            </author>
            <title type="text">{!! $item->title !!}</title>
            <link rel="alternate" type="text/html" href="{{$item->link}}"></link>
            <id>{{$item->link}}</id>
            <summary type="html"><![CDATA[{!!$item->description!!}]]></summary>
            @if (!empty($item->content))
                <content type="html"><![CDATA[{!!$item->content!!}]]></content>
            @endif
            <updated>{{$item->pubdate}}</updated>
        </entry>
    @endforeach
</feed>