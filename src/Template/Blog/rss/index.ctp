<?php
$parsedown = new ParsedownExtra();

$this->set('channelData', [
    'title' => __("Articles Feed"),
    'link' => $this->Url->build('/', true),
    //'language' => 'en-us'
]);

foreach ($articles as $article) {
    $created = strtotime($article->created);

    $link = [
        'controller' => 'Blog',
        'action' => 'show',
        'slug' => $article->slug
    ];

    $body = $parsedown->text($article->content);
    $body = h(strip_tags($body));
    $body = $this->Text->truncate($body, 380, [
        'ending' => '...',
        'exact' => true,
        'html' => true
    ]);
    
    echo $this->Rss->item([], [
        'title' => $article->title,
        'link' => $link,
        'guid' => ['url' => $link, 'isPermaLink' => 'true'],
        'description' => $body,
        'pubDate' => $article->created
    ]);
}
