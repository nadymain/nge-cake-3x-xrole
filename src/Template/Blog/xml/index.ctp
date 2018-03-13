<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= $this->Url->build('/', true); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <?php foreach ($articles as $article) : ?>
        <?php
            $time = strtotime($article->created);
            $link = [
                'controller' => 'Blog',
                'action' => 'show',
                'slug' => $article->slug
            ];
        ?> 
        <url>
            <loc><?= $this->Url->build($link, true) ?></loc>
            <lastmod><?= $this->Time->toAtom($time); ?></lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    <?php endforeach; ?>
</urlset>
