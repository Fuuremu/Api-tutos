<?php

namespace tutoAPI\Controllers;

use tutoAPI\Models\TutoManager;
use tutoAPI\Models\Tuto;
use tutoAPI\Controllers\abstractController;

class tutoController extends abstractController
{

    public function show($id)
    {

        // Données issues du Modèle

        $manager = new TutoManager();

        $tuto = $manager->find($id);

        // Template issu de la Vue

        return $this->jsonResponse($tuto, 200);
    }

    public function index()
    {

        $tutos = [];

        $manager = new TutoManager();

        $tutos = $manager->findAll();

        return $this->jsonResponse($tutos, 200);
    }

    public function indexPage($page)
    {
        $tutos = [];

        $manager = new TutoManager();

        $tutos = $manager->findPage($page);

        return $this->jsonResponse($tutos, 200);
    }

    public function add()
    {

        // Ajout d'un tuto

        $tuto = new Tuto();
        $tuto->setTitle($_POST['title']);
        $tuto->setDescription($_POST['description']);
        $now = new \DateTime();

        $dateString = date( 'Y-m-d', $now->getTimestamp());
        $tuto->setCreatedAt($dateString);
        /*$dateString = strftime('%Y-%m-%d' , $now->getTimestamp());
        $tuto->setCreatedAt(strftime('%Y-%m-%d', $dateString));*/

        $manager = new TutoManager();
        $tuto = $manager->add($tuto);

        return $this->jsonResponse($tuto, 201);
    }

    public function update($id){
        
        parse_str(file_get_contents('php://input'), $_PATCH);

        $manager = new TutoManager();
        $tuto = new Tuto();

        $tuto->setId($id);
        $tuto->setTitle($_PATCH['title']);
        $tuto->setDescription($_PATCH['description']);
        $now = new \DateTime();
        $dateString = date( 'Y-m-d', $now->getTimestamp());
        $tuto->setCreatedAt($dateString);
        $tuto = $manager->update($tuto);
        var_dump($_PATCH); die();
    }

    public function delete($id){
        $manager = new TutoManager();
        $tuto = new Tuto();
        $tuto->setId($id);
        $msg = $manager->delete($tuto->getId());
        var_dump($msg); die();
    }

}
