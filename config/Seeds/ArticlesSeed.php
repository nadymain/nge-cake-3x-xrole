<?php
use Migrations\AbstractSeed;

/**
 * Articles seed.
 */
class ArticlesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'title' => 'First Article',
                'slug' => 'first-article',
                'content' => '# H1

Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
In malesuada porta pulvinar. Mauris nibh tellus, viverra non hendrerit a, 
tincidunt non nisl. Ut volutpat nisi metus, eu viverra justo tempor vel. 

Proin eget consectetur purus. Sed vehicula fermentum ante a ornare. 
Vestibulum aliquet massa id eros bibendum, nec maximus magna viverra. 
Suspendisse iaculis fringilla mauris vehicula pellentesque.

## H2

In eu enim eget nisl euismod aliquet. Orci varius natoque penatibus et 
magnis dis parturient montes, nascetur ridiculus mus. 
Vivamus ultrices enim risus, vitae blandit velit hendrerit a. 

Mauris ante elit, finibus a vulputate non, dapibus nec nisl. 
Praesent in ex velit. Donec finibus gravida consequat.
Quisque hendrerit non ligula ac varius. Morbi ac sodales ligula. 
Donec non maximus elit. Nunc dictum ac tellus sed finibus. 

### H3

Nulla et turpis vitae est aliquam fringilla. Duis ultricies nisl lectus, 
ac scelerisque augue mattis id. Suspendisse a scelerisque urna. 

#### H4

Emphasis, aka italics, with *asterisks* or _underscores_.

Strong emphasis, aka bold, with **asterisks** or __underscores__.

Combined emphasis with **asterisks and _underscores_**.

Strikethrough uses two tildes. ~~Scratch this.~~

1. First ordered list item
2. Another item

* Unordered list can use asterisks
- Or minuses
+ Or pluses

[I\'m an inline-style link](https://cakephp.org)

```
No language indicated, so no syntax highlighting. 
But let\'s throw in a <b>tag</b>.
```

Tables | Head | xxx
-      | -    | - 
1      | 2    | 3
4      | 5    | 6

> Blockquotes are very handy in email to emulate reply text.
> This line is part of the same quote.

Quote break.

> This is a very long line that will still be quoted properly when it wraps. Oh boy let\'s keep writing to make sure this is long enough to actually wrap for everyone. Oh, you can *put* **Markdown** into a blockquote. 

---

Here\'s a line for us to start with.

This line is separated from the one above by two newlines, so it will be a *separate paragraph*.

This line is also a separate paragraph, but...
This line is only separated by a single newline, so it\'s a separate line in the *same paragraph*.
',
                'description' => '',
                'image' => '',
                'status' => '1',
                'created' => '2018-03-12 09:40:00',
                'modified' => '2018-03-12 09:53:38',
            ],
        ];

        $table = $this->table('articles');
        $table->insert($data)->save();
    }
}
