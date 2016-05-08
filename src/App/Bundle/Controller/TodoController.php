<?php

namespace App\Bundle\Controller;

use App\Form\Type\TodoType;
use App\Model\Command\NewTodo;
use App\Model\Entity\Todo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TodoController extends Controller
{
    /**
     * @Route("/", name="todo_list")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $todoList = $this->getDoctrine()->getRepository(Todo::class)
            ->findAll()
        ;

        $newTodoForm = $this->createForm(TodoType::class);
        $newTodoForm->handleRequest($request);

        if ($newTodoForm->isValid()) {
            /** @var NewTodo $todoCommand */
            $todoCommand = $newTodoForm->getData();
            $newTodo = Todo::create($todoCommand->content);

            $em = $this->getDoctrineManager();
            $em->persist($newTodo);
            $em->flush();

            return $this->redirectToRoute('todo_list');
        }

        return $this->render('AppBundle:Todo:index.html.twig', [
            'todoList' => $todoList,
            'newTodoForm' => $newTodoForm->createView(),
        ]);
    }

    /**
     * @Route("/mark_as_done/{todo}", name="todo_mark_as_done")
     * @Method({"POST"})
     */
    public function markTodoAsDoneAction(Todo $todo)
    {
        $todo->markAsDone();
        $this->getDoctrineManager()->flush();

        $this->addFlash('notice', 'todo.marked_as_done');

        return $this->redirectToRoute('todo_list');
    }

    /**
     * @Route("/delete/{todo}", name="todo_delete")
     * @Method({"POST"})
     */
    public function deleteTodoAction(Todo $todo)
    {
        $em = $this->getDoctrineManager();
        $em->remove($todo);
        $em->flush();

        $this->addFlash('notice', 'todo.deleted');

        return $this->redirectToRoute('todo_list');
    }

    private function getDoctrineManager()
    {
        return $this->getDoctrine()->getManager();
    }
}
