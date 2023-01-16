<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\NewToDoForm;
use App\Repository\TodoRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToDoController extends AbstractController{

    public function index(TodoRepository $todolist){
        // List fetching
        $todos = $todolist->findAll();

        return $this->render('todos/index.html.twig', [
            'todos' => $todos
        ]);
    }

    public function create(Request $request, ManagerRegistry $doctrine){
        // Initializing
        $em = $doctrine->getManager();
        $todo = new Todo();
        $form = $this->createForm(NewToDoForm::class, $todo);

        // Value allocation
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Adding hidden values
            $todo->setIscompleted(false);

            // Saving
            $em->persist($todo);
            // Query execution
            $em->flush();

            // Return back
            return $this->redirect($this->generateUrl('todolist.index'));
        }

        // Return back
        return $this->render('todos/create.html.twig', [
            'tdform' => $form->createView()
        ]);
    }

    public function remove(Todo $todo, ManagerRegistry $doctrine){
        // Initializing
        $em = $doctrine->getManager();
        // Removing
        $em->remove($todo);
        // Query execution
        $em->flush();

        $this->addFlash('success', 'You have successfully completed the task');

        // Return back
        return $this->redirect($this->generateUrl('todolist.index'));
    }
}