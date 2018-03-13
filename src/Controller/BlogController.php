<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

class BlogController extends AppController
{
    /**
     * initialize
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent(
            'Search.Prg', ['actions' => ['index']]
        );
        $this->Auth->allow([
            'index',
            'show',
            'tags'
        ]);
    }

    /**
     * index
     */
    public function index()
    {
        $this->loadModel('Articles');

        if ($this->RequestHandler->isRss()) {
            $articles = $this->Articles
                ->find()
                ->limit(5)
                ->where(['Articles.status' => 1])
                ->order(['created' => 'desc']);

            $this->set(compact('articles'));

        } elseif ($this->RequestHandler->isXml()) {
            $articles = $this->Articles
                ->find()
                ->where(['Articles.status' => 1])
                ->order(['created' => 'desc']);

            $this->set(compact('articles'));
            $this->set('_serialize', false);
            
        } else {
            $this->paginate = [
                'limit' => Configure::read('articles_page'),
                'order' => ['Articles.created' => 'desc']
            ];

            $query = $this->Articles
                ->find('search', ['search' => $this->request->query])
                ->where([
                    'Articles.status' => 1,
                    'Articles.title IS NOT' => null
                ]);

            $this->set('articles', $this->paginate($query));
        }
    }

    /**
     * show
     */
    public function show($slug)
    {
        $this->loadModel('Articles');

        $article = $this->Articles
            ->findBySlug($slug)
            ->contain(['Tags'])
            ->where(['Articles.status' => 1])
            ->firstOrFail();

        $this->set(compact('article'));

        // prevnext
        $prev = $this->Articles
			->find()
			->where(['created >' => $article->created, 'Articles.status' => 1])
			->order(['created' => 'ASC'])
            ->first();
            
        $next = $this->Articles
			->find()
			->where(['created <' => $article->created, 'Articles.status' => 1])
			->order(['created' => 'DESC'])
            ->first();
            
        $this->set(compact('prev', 'next'));
    }

    /**
     * tags
     */
    public function tags($slug)
    {
        // tag
        $this->loadModel('Tags');

        $tag = $this->Tags
            ->findBySlug($slug)
            ->where([
                'Tags.article_count >=' => 1,
            ])
            ->firstOrFail();

        $this->set(compact('tag'));

        // tagged
        $this->loadModel('Articles');
        
        $this->paginate = [
            'limit' => Configure::read('articles_page'),
            'order' => ['Articles.created' => 'desc']
        ];

        $tags = $this->request->getParam('pass');
        $query = $this->Articles
            ->find('tagged', [
                'tags' => $tags
            ])
            ->where([
                'Articles.status' => 1
            ]);

        $this->set('articles', $this->paginate($query));
    }
}