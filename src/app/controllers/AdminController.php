<?php

use Phalcon\Mvc\Controller;


class AdminController extends Controller
{
    public function indexAction()
    {
        echo "i am inside admin index page";
      //  print_r(Users::find());
       // $this->view->users = Users::find();
       $table = Users::find();
        $j = json_encode($table);
        $de = json_decode($j, true);
        print_r($de);
        $this->view->users = $de;
       //die();
    }


    public function statusAction()
    {
        echo "inside admin staus ";
        print_r($this->request->getPost());

        $status =  $this->request->getPost('status');
        $id =  $this->request->getPost('id');
        $btn =  $this->request->getPost('btn');
        $row = Users::findFirst(
            [
                "id = '$id'",
            ]
        );

        
        if($btn == 'change')
        {
            if($status == 'restricted')
            {
                $row->status = 'approved';
                $row->save();
            }
            else if($status == 'approved')
            {
                $row->status = 'restricted';
                $row->save();
            }
            
        }
        else if($btn == 'delete'){    
            $row->delete();
           
        }
        $this->response->redirect('/admin');
       // die();
    }

}