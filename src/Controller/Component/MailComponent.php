<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Mailer\Email;

class MailComponent extends Component
{
    public function sendMail($mailAdd, $template = '')
    {
        error_log(print_r($mailAdd, true) . "\n\n=====================\n", 3, '/var/www/DEV_JP/logs/debug_mail.txt');
        
        $email = new Email('default');
        //$email->from(['me@example.com' => 'My Site'])
        $email->setTemplate('Blog.new_comment');
        $email->setSender('me@example.com', 'My Site')
        
        ->addTo('you@example.com', 'demo')
        ->setSubject('About')
        ->send('My messageAAAAAAAAAAAAAAa');
    }
}