<?php

namespace App\Controller;

use App\Entity\Club;
use App\Entity\News;
use App\Form\NewsType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin/addnews", name="addNews")
     */
    public function addNews(Request $request)
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form
            ->add('chooseExistingPhoto', ChoiceType::class, array(
                'label' => 'Si vous n\'avez pas de photo, choisissez une photo préenregistrée parmis les suivantes(pas de choix = logo POM)',
                'mapped' => false,
                'required' => false,
                'multiple' => false,
                'placeholder' => false,
                'choices' => array(
                    ' J\'ai ma propre photo' => null,
                    'CNEC' => 'PhotoCnec',
                    'Cours' => 'PhotoLesson',
                    'Entrainement' => 'PhotoTraining',
                    'Important' => 'PhotoImportant'
                )))
            ->add('Valider', SubmitType::class, array(
                'label' => 'Valider la news',
                'attr' => array(
                    'class' => 'btn btn-dark btn-lg btn-block'
                )));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $choix = $form->get('chooseExistingPhoto')->getData();
            switch ($choix) {
                case null :
                    $photo = $news->getPhoto();
                    if ($photo == null) {
                        $news->setPhoto('./images/articles/base/logoPom.jpg');
                    } else {
                        $photoname = $this->generateUniqueFileName() . '.' . $photo->guessExtension();
                        $photo->move('./images/articles/uploaded/', $photoname);
                        $news->setPhoto('./images/articles/uploaded/'.$photoname);
                    }
                    break;
                case "PhotoCnec" :
                    $news->setPhoto('./images/articles/base/logoCNEC.jpg');
                    break;
                case "PhotoLesson" :
                    $news->setPhoto('./images/articles/base/logoLessons.png');
                    break;
                case "PhotoTraining" :
                    $news->setPhoto('./images/articles/base/logoTraining.jpg');
                    break;
                case "PhotoImportant" :
                    $news->setPhoto('./images/articles/base/logoImportant.jpg');
                    break;
                default :
                    $news->setPhoto('./images/articles/base/logoPom.jpg');
                    break;
            }
            $Manager = $this->getDoctrine()->getManager();
            $Manager->persist($news);
            $Manager->flush();

            return $this->redirectToRoute('Home');
        }
        return $this->render('page/admin/addNews.html.twig', array('form' => $form->createView()));
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
