<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
       
    }
    public function loginAction()
    {
        print_r( $this->request->getPost());

        if ($this->request->isPost()) {
            $password = $this->request->getPost("password");
            $email = $this->request->getPost("email");
        }
      

        $success = Users::findFirst(array(
            'email = :email: and password = :password:', 'bind' => array(
                'email' => $this->request->getPost("email"),
                'password' => $this->request->getPost("password")
            )
        ));

      //  print_r($success->role);
      //  die();

       
        if ($success) {
            echo "successful login";

            if($success->role == 'user')
            {
            $this->session->set('email', $email);
            $this->session->set('password', $password);
           $this->response->redirect('/dashboard');
            }
            else if($success->role == 'admin')
            {
                $this->session->set('email', $email);
                $this->session->set('password', $password);
               $this->response->redirect('/admin');
            }


          
        }

       
    }
}