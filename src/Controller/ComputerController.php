<?php

namespace App\Controller;

use App\Entity\Computer;
use App\Form\ComputerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

class ComputerController extends AbstractController
{
    /**
     * @Route("/computers", name="computer", methods={"Get"})
     */
    public function index()
    {
        $computers = $this->getDoctrine()->getManager()->getRepository( Computer::class )->findAll();
        $return = [];
        foreach ($computers as $computer) {
           $return[] = $computer->toArray();
        }
        return $this->json($return, 200);
    }

    /**
     * @Route("/computers/{computer}", name="computer_id", methods={"Get"})
     */
    public function getOne(Computer $computer)
    {
        return $this->json($computer->toArray(), 200);
    }

    /**
     * @Route("/computers/{computer}", name="computer_delete", methods={"delete"})
     */
    public function seleteOne(Computer $computer)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($computer);
        $em->flush();

        return new JsonResponse(['success'=> true], 200);
    }

    /**
    * @Route("/computers", name="add_computer", methods={"Post"})
    */
    public function addOne(Request $request)
    {
        $form = $this->createForm(ComputerType::class, new Computer());

        $this->processForm($request, $form);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $form = $form->getData();
            $form->setDateEnterStock(new \DateTime($form->getDateEnterStock()));
            $em->persist($form);
            $em->flush();

            return new JsonResponse(['success'=>true, 'data'=>$form->toArray()] , 200);
        } else {

            return $this->json($form->getErrors(true, false), 400);
        }

        // return new JsonResponse($return, 200);

    }

    private function processForm(Request $request, Form $form)
    {
        $data = json_decode($request->getContent(), true);
        $clearMissing = $request->getMethod() != 'PATCH';
        $form->submit($data, $clearMissing);
    }

    /**
    * @Route("/computers/{computer}", name="edit_computer", methods={"Put"})
    */
    public function editOne(Computer $computer, Request $request)
    {
        $form = $this->createForm(ComputerType::class, $computer);

        $this->processForm($request, $form);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $form = $form->getData();
            $form->setDateEnterStock(new \DateTime($form->getDateEnterStock()));
            $em->persist($form);
            $em->flush();

            return new JsonResponse(['success'=>true, 'data'=>$form->toArray()] , 200);
        } else {

            return $this->json($form->getErrors(true, false), 400);
        }

        // return new JsonResponse($return, 200);

    }


}
