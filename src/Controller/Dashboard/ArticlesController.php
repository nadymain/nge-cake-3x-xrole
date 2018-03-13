<?php
namespace App\Controller\Dashboard;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 *
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{

    /**
     * paginate
     */
    public $paginate = [
        'limit' => 3,
        'order' => ['Articles.created' => 'desc']
    ];

    /**
     * initialize
     */
    public function initialize()
    {
        parent::initialize();
    
        $this->loadComponent(
            'Search.Prg', ['actions' => ['index']]
        );
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Articles
            ->find('search', ['search' => $this->request->query])
            ->contain(['Tags'])
            ->where(['title IS NOT' => null]);

        $articles = $this->paginate($query);
        $tags = $this->Articles->Tags->find('list');
        $this->set(compact('articles', 'tags'));

        // status
        $total = $this->Articles
            ->find()
            ->count();
        $publish = $this->Articles
            ->find()
            ->where([
                'Articles.status' => '1'
            ])
            ->count();
        $draft = $this->Articles
            ->find()
            ->where([
                'Articles.status' => '0'
            ])
            ->count();
        $this->set(compact('total', 'publish', 'draft'));
        
        // setLayout
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'edit', $article->id]);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $tags = $this->Articles->Tags->find('all');
        $this->set(compact('article', 'tags'));

        // setLayout
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been updated.'));

                return $this->redirect(['action' => 'edit', $article->id]);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $tags = $this->Articles->Tags->find('all', ['fields' => ['name']]);
        $this->set(compact('article', 'tags'));

        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * updateStatus 
     */
	public function updateStatus($id = null, $status = null)
    {
        $article = $this->Articles->get($id);
        if ($this->request->is(['post'])) {
            $article->status = 1 - $status;
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been updated.'));
            } else {
                $this->Flash->error(__('The article could not be updated.'));
            }
        }

        return $this->redirect($this->referer());
    }
    
}
