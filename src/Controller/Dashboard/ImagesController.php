<?php
namespace App\Controller\Dashboard;

use App\Controller\AppController;

/**
 * Images Controller
 *
 * @property \App\Model\Table\ImagesTable $Images
 *
 * @method \App\Model\Entity\Image[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ImagesController extends AppController
{

    /**
     * paginate
     */
    public $paginate = [
        'limit' => 10,
        'order' => ['Images.created' => 'desc']
    ];

    /**
     * initialize
     */
    public function initialize()
    {
        parent::initialize();
    
        $this->loadComponent(
            'Search.Prg', ['actions' => ['index', 'iframe']]
        );
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Images
            ->find('search', ['search' => $this->request->query])
            ->where(['file IS NOT' => null]);

        $images = $this->paginate($query);

        $total = $this->Images
            ->find()
            ->count();

        $this->set(compact('images', 'total'));

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
        $image = $this->Images->newEntity();
        if ($this->request->is('post')) {
            $image = $this->Images->patchEntity($image, $this->request->getData());
            if ($this->Images->save($image)) {
                $this->Flash->success(__('The image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The image could not be saved. Please, try again.'));
        }
        $this->set(compact('image'));

        // setLayout
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Delete method
     *
     * @param string|null $id Image id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $image = $this->Images->get($id);
        if ($this->Images->delete($image)) {
            $this->Flash->success(__('The image has been deleted.'));
        } else {
            $this->Flash->error(__('The image could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    /**
     * iframe method
     *
     * @return \Cake\Http\Response|void
     */
    public function iframe()
    {
        $query = $this->Images
            ->find('search', ['search' => $this->request->query])
            ->where(['file IS NOT' => null]);

        $images = $this->paginate($query);

        $total = $this->Images
            ->find()
            ->count();

        $this->set(compact('images', 'total'));

        // setLayout
        $this->viewBuilder()->setLayout('iframe');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addiframe()
    {
        $image = $this->Images->newEntity();
        if ($this->request->is('post')) {
            $image = $this->Images->patchEntity($image, $this->request->getData());
            if ($this->Images->save($image)) {
                $this->Flash->success(__('The image has been saved.'));

                return $this->redirect(['action' => 'iframe']);
            }
            $this->Flash->error(__('The image could not be saved. Please, try again.'));
        }
        $this->set(compact('image'));

        // setLayout
        $this->viewBuilder()->setLayout('iframe');
    }
}
