<?php

use Phalcon\Mvc\Controller;


class DashboardController extends Controller
{
    public function indexAction()
    {
        //$this->view->table = Posts::find();    
        $table = Posts::find();
        $j = json_encode($table);
        $de = json_decode($j, true);
        // echo "<pre>";
        // print_r($d);
        // echo "</pre>";


        // echo "------------------------------------------";
        // echo count($d);
        // $i = 0;
        // while(count($d) > $i)
        // {
        //     echo $d[$i]['username'];
        //     echo "<br>";
        //     $i++;
        // }





        $this->view->d = $de;
        // 
        //die();


    }




    public function addAction()
    {
    }


    public function addtodbAction()
    {
        print_r($this->request->getPost());
        echo "date  = >";
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-y h:i:s');
        //  echo $date;


        $name =  $this->request->getPost('name');
        $title =  $this->request->getPost('title');
        $content =  $this->request->getPost('content');

        $post = new Posts();

        $post->username = $name;
        $post->title = $title;
        $post->content = $content;
        $post->date = $date;

        $post->save();

        echo " successgul insert ";
        $this->response->redirect('/dashboard');
    }






    public function editAction()
    {
        $edit_var = "";
        print_r($this->request->getPost());
        $edit_id  = $this->request->getPost('edit_id2');
        echo "my edit id is = " . $edit_id;
        $table = Posts::findFirst(
            [
                "id = '$edit_id'",
            ]
        );


        // echo "my table<pre>";
        // print_r($table);
        // echo "</pre>";

        $this->view->edit_var = $table;
        // die();

    }

    public function updateAction()
    {
        echo "i am inside update action ";
        print_r($this->request->getPost());

        $id2  = $this->request->getPost('id2');
        $name =  $this->request->getPost('name');
        $title =  $this->request->getPost('title');
        $content =  $this->request->getPost('content');
        $date =  $this->request->getPost('date');


        $particular_column = Posts::findFirst(
            [
                "id = '$id2'",
            ]
        );


        $particular_column->id = $id2;
        $particular_column->username = $name;
        $particular_column->title = $title;
        $particular_column->content = $content;
        $particular_column->date = $date;


        $particular_column->save();


        $this->response->redirect('/dashboard');
    }



    public function deleteAction()
    {
        print_r($this->request->getPost());

        $did =  $this->request->getPost('delete_id2');
        echo $did;

        $particular_column = Posts::findFirst(
            [
                "id = '$did'",
            ]
        );

        $particular_column->delete();



        echo " succefully deleted";

        $this->response->redirect('/dashboard');
    }
}
