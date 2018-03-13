<?php
namespace App\Form;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Mailer\Email;
use Cake\Core\Configure;

class ContactForm extends Form
{
    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('name', 'string')
        ->addField('email', ['type' => 'string'])
        ->addField('message', ['type' => 'text']);
    }

    protected function _buildValidator(Validator $validator)
    {
        return $validator
            ->add('name', 'length', [
                'rule' => ['maxLength', 20],
                'message' => 'A name max length 20'
            ])
            ->add('email', 'format', [
                'rule' => 'email',
                'message' => 'A valid email address is required'
            ])
            ->add('message', 'length', [
                'rule' => ['minLength', 10],
                'message' => 'A message min length 10'
            ]);
    }

    protected function _execute(array $data)
    {
        $email = new Email('default');
        $email
            ->to(Configure::read('site_email'))
            ->subject('Contact form submission')
            ->from($data['email'])
            ->viewVars($data)
            ->template('contact', 'default')
            ->emailFormat('text')
            ->send();
            
        return true;
    }
}
        