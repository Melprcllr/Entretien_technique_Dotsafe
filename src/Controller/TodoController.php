<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/')]
class TodoController extends AbstractController
{
    #[Route('/', name: 'app_todo_index', methods: ['GET'])]
    public function index(TodoRepository $todoRepository): Response
    {
        $todos = $todoRepository->findAll();
        $completedTodos = $todoRepository->findBy(['completed' => true]);
        $totalTodos = count($todos);
        $completedCount = count($completedTodos);

        $remainingTodos = $totalTodos - $completedCount;
        if ($remainingTodos == 0) {
            $message = "Bravo!! Vous avez accompli toutes les tâches !";
        } elseif ($remainingTodos < $totalTodos / 2) {
            $message = "Encore un effort ! Continuez !";
        } else {
            $message = "";
        }

        return $this->render('todo/index.html.twig', [
            'todos' => $todos,
            'completedCount' => $completedCount,
            'totalTodos' => $totalTodos,
            'message' => $message,
        ]);
    }

    #[Route('/new', name: 'app_todo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $todo = new Todo();
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($todo);
            $entityManager->flush();

            return $this->redirectToRoute('app_todo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('todo/new.html.twig', [
            'todo' => $todo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_todo_show', methods: ['GET'])]
    public function show(Todo $todo): Response
    {
        return $this->render('todo/show.html.twig', [
            'todo' => $todo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_todo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Todo $todo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_todo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('todo/edit.html.twig', [
            'todo' => $todo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_todo_delete', methods: ['POST'])]
    public function delete(Request $request, Todo $todo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$todo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($todo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_todo_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/complete', name: 'complete_todo', methods: ['GET'])]
    public function complete(Todo $todo, EntityManagerInterface $entityManager): RedirectResponse
    {
        $todo->setCompleted(true);
        $entityManager->flush();

        return $this->redirectToRoute('app_todo_index');
    }

    #[Route('/todos/completed/delete', name: 'app_todo_completed_delete', methods: ['POST'])]
    public function deleteAllCompleted(TodoRepository $todoRepository): Response
    {
        $todoRepository->deleteAllCompleted();

        return $this->redirectToRoute('app_todo_index');
    }
}
