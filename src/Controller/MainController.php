<?php

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Section;
use App\Entity\Tag;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'public_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $authors = $entityManager->getRepository(User::class)->findAll();
        $categs = $entityManager->getRepository(Section::class)->findAll();
        $arts = $entityManager->getRepository(Article::class)->findAll();
        $tags = $entityManager->getRepository(Tag::class)->findAll();
        return $this->render('main/index.html.twig', [
            'authors' => $authors,
            'cats' => $categs,
            'arts' => $arts,
            'tags' => $tags,
        ]);
    }

    #[Route('/author/{id}', name: 'public_author', methods: ['GET'])]
    public function author(EntityManagerInterface $entityManager, int $id): Response
    {
        $arts = $entityManager->getRepository(Article::class)->getArticlesByAuthorId($id);
        $author = $entityManager->getRepository(User::class)->find($id);
        return $this->render('main/author.html.twig', [
            'author' => $author,
            'arts' => $arts,
        ]);
    }

    #[Route('/section/{id}', name: 'public_section', methods: ['GET'])]
    public function section(EntityManagerInterface $entityManager, int $id): Response
    {
        $arts = $entityManager->getRepository(Article::class)->getArticlesBySectionId($id);
        $section = $entityManager->getRepository(Section::class)->find($id);
        return $this->render('main/section.html.twig', [
            'section' => $section,
            'arts' => $arts,
        ]);
    }




}
