<?php
namespace App\Controller;
use App\Controller\AppController;
use App\Form\ContactForm;

class ContactController extends AppController
{
    /**
     * initialize
     */
    public function initialize()
    {
        parent::initialize();

        $this->Auth->allow(['index']);
    }

    public function index()
    {
        $contact = new ContactForm();
        if ($this->request->is('post')) {
            if ($contact->execute($this->request->getData())) {
                $this->Flash->success('Contact form was submitted successfully.');
            } else {
                $this->Flash->error('Oops! It looks like something went wrong.');
            }
        }

        if ($this->request->is('get')) {
            $this->request->data('name');
            $this->request->data('email');
            $this->request->data('message');
        }

        $this->set('contact', $contact);
    }
}