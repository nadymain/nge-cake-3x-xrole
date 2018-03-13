<?php
namespace App\Controller\Dashboard;

use App\Controller\AppController;

/**
 * Menus Controller
 *
 * @property \App\Model\Table\MenusTable $Menus
 *
 * @method \App\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MenusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->set('menus', $this->Menus
            ->find()
            ->order(['Menus.lft' => 'asc'])
            ->contain(['ParentMenus'])
        );

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
        $menu = $this->Menus->newEntity();
        if ($this->request->is('post')) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'edit', $menu->id]);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $parentMenus = $this->Menus->ParentMenus->find('treeList')->where(['parent_id IS' => null]);
        $this->set(compact('menu', 'parentMenus'));

        // setLayout
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been updated.'));

                return $this->redirect(['action' => 'edit', $menu->id]);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $parentMenus = $this->Menus->ParentMenus->find('treeList')->where(['parent_id IS' => null]);
        $this->set(compact('menu', 'parentMenus'));

        // setLayout
        $this->viewBuilder()->setLayout('dashboard');
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->delete($menu)) {
            $this->Flash->success(__('The menu has been deleted.'));
        } else {
            $this->Flash->error(__('The menu could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * moveUp method
     */
    public function moveUp($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->moveUp($menu)) {
            $this->Flash->success('The menu has been moved Up.');
        } else {
            $this->Flash->error('The menu could not be moved up. Please, try again.');
        }

        return $this->redirect($this->referer());
    }

    /**
     * moveDown method
     */
    public function moveDown($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->moveDown($menu)) {
            $this->Flash->success('The menu has been moved down.');
        } else {
            $this->Flash->error('The menu could not be moved down. Please, try again.');
        }

        return $this->redirect($this->referer());
    }
    
}
