<?php

namespace App\Controller;

use DateTime;
use App\Entity\Chambre;
use App\Form\ChambreFormType;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class ChambreController extends AbstractController
{

    #[Route('/admin/ajouter-une-chambre', name: 'create_chambre', methods: ['GET', 'POST'])]
    public function createChambre(Request $request, ChambreRepository $repo, EntityManagerInterface $entityManager, SluggerInterface $slug): Response
    {
        $chambre = new Chambre();

        $form = $this->createForm(ChambreFormType::class, $chambre)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $chambre->setCreatedAt(new DateTime());
            $chambre->setUpdatedat(new DateTime());
            $chambre->setDispo(true);


            /** @var UploadedFile $photo */
            $photo = $form->get('photo')->getData();

            if ($photo) {
                $this->handleFile($chambre, $photo, $slug);
            } // end if($photo)

            $repo->save($chambre, true);

            return $this->redirectToRoute('create_chambre');
        } // end if($form)

        $chambres = $entityManager->getRepository(Chambre::class)->findBy(['deletedAt' => null, 'dispo' => true]);

        return $this->render('admin/chambre/form.html.twig', [
            'form' => $form->createView(),
            'chambres' => $chambres
        ]);
    } // end createChambre()

    
    #[Route('/admin/modifier-une-chambre/{id}', name: 'update_chambre', methods: ['GET', 'POST'])]
    public function updateChambre(Chambre $chambre, Request $request, ChambreRepository $repo, SluggerInterface $slug, EntityManagerInterface $entityManager): Response
    {
        $currentPhoto = $chambre->getPhoto();

        $form = $this->createForm(ChambreFormType::class, $chambre, [
            'photo' => $currentPhoto
        ])
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $chambre->setUpdatedat(new DateTime());

            $newPhoto = $form->get('photo')->getData();

            if ($newPhoto) {
                $this->handleFile($chambre, $newPhoto, $slug);
            } else {
                $chambre->setPhoto($currentPhoto);
            } // end if($newPhoto)

            $repo->save($chambre, true);

            return $this->redirectToRoute('create_chambre');
        } // end if($form)

        $chambres = $entityManager->getRepository(Chambre::class)->findBy(['deletedAt' => null]);

        return $this->render('admin/chambre/form.html.twig', [
            'form' => $form->createView(),
            'chambre' => $chambre,
            'chambres' => $chambres
        ]);
    } // end updateChambre()

    #[ROUTE('/admin/archiver-une-chambre/{id}', name: 'soft_delete_chambre', methods: ['GET'])]
    public function softDeleteChambre(Chambre $chambre, ChambreRepository $repo): Response
    {
        $chambre->setDeletedAt(new DateTime());
        $repo->save($chambre, true);

        return $this->redirectToRoute('create_chambre');
    }


    private function handleFile(Chambre $chambre, UploadedFile $photo, SluggerInterface $slug)
    {
        $extension = '.' . $photo->guessExtension();

        $safeFilename = $slug->slug(pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME));

        $newFilename = $safeFilename . '-' . uniqid("", true) . $extension;

        try {
            $photo->move($this->getParameter('uploads_dir'), $newFilename);
            $chambre->setPhoto($newFilename);
        } catch (FileException $exception) {
        } // end catch()

    } // end handleFile()

}// end Chambre()
