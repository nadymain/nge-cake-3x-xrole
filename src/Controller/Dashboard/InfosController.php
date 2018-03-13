<?php
namespace App\Controller\Dashboard;

use App\Controller\AppController;

/**
 * Infos Controller
 *
 * @property \App\Model\Table\InfosTable $Infos
 *
 * @method \App\Model\Entity\Info[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InfosController extends AppController
{

    /**
     * paginate
     */
    public $paginate = [
        'limit' => 10,
        'order' => ['Infos.created' => 'desc']
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $infos = $this->paginate($this->Infos);

        $this->set(compact('infos'));
        
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
        $info = $this->Infos->newEntity();
        if ($this->request->is('post')) {
            $info = $this->Infos->patchEntity($info, $this->request->getData());
            if ($this->Infos->save($info)) {
                $this->Flash->success(__('The info has been saved.'));

                return $this->redirect(['action' => 'edit', $info->id]);
            }
            $this->Flash->error(__('The info could not be saved. Please, try again.'));
        }
        $this->set(compact('info'));
                
        // setLayout
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Edit method
     *
     * @param string|null $id Info id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $info = $this->Infos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $info = $this->Infos->patchEntity($info, $this->request->getData());
            if ($this->Infos->save($info)) {
                $this->Flash->success(__('The info has been updated.'));

                return $this->redirect(['action' => 'edit', $info->id]);
            }
            $this->Flash->error(__('The info could not be saved. Please, try again.'));
        }
        $this->set(compact('info'));
                
        // setLayout
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Delete method
     *
     * @param string|null $id Info id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $info = $this->Infos->get($id);
        if ($this->Infos->delete($info)) {
            $this->Flash->success(__('The info has been deleted.'));
        } else {
            $this->Flash->error(__('The info could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * updateStatus 
     */
	public function updateStatus($id = null, $status = null)
    {
        $info = $this->Infos->get($id);

        $info->status = 1 - $status;
        if ($this->Infos->save($info)) {
            $this->Flash->success(__('The article has been updated.'));
        } else {
            $this->Flash->error(__('The article could not be updated.'));
        }

        return $this->redirect($this->referer());
    }
}
