<?php
namespace App\Controller;

use App\Controller\AppController;

class LoggedController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        
        $this->Auth->allow(['in', 'out']);
    }
    
    public function in()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                $this->Flash->success(__('You have been successfully logged in.'));
                
                return $this->redirect($this->Auth->redirectUrl());
            }

            $this->Flash->error('Your username or password is incorrect.');
            $this->request->data['password'] = '';
        }

        if ($this->Auth->user('id')) {
            $this->Flash->success(__('You are logged in!'));
            
            return $this->redirect($this->Auth->redirectUrl());
        }
    }

    public function out()
    {
        $this->Flash->success('You are now logged out.');
        
        return $this->redirect($this->Auth->logout());
    }

}
