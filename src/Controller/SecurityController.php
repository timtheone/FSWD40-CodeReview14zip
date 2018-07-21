<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\UserType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SecurityController extends Controller
{
    /**
     * @Route("/sign_in", name="sign_in")
     */
    public function sign_in(Request $request, AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();
        
        return $this->render('security/sign_in.html.twig', [
            'error'         => $error,
            'last_username' => $lastUsername
        ]);
    }

    /**
     * @Route("/sign_up", name="sign_up")
     */
    public function sign_up(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $user = new User();
        $user->setRoles('ROLE_USER');

        // $form = $this->createFormBuilder($user)
        // ->add('username', TextType::class, array(
        //     'attr' => array('class' => 'form-control')))
        // ->add('email', EmailType::class, array(
        //     'attr' => array('class' => 'form-control')))
        // ->add('password', PasswordType::class, array('attr' => array('class' => 'form-control')))
        // ->add('save', SubmitType::class, array('label'=> 'Sign up', 'attr' => array('class'=> 'btn btn-primary mt-5')))
        // ->getForm();

        $form = $this->createForm(UserType::class, $user);

        $form -> handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()){
            $password = $form['password'] -> getData();
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $password)
            );

            $EntityManager = $this -> getDoctrine() -> getManager();
            $EntityManager -> persist($user);
            $EntityManager -> flush();

            return $this -> redirectToRoute('event_index');
        }
        
                

        return $this->render('security/sign_up.html.twig', [
            'user'          => $user,
            'form' => $form -> createView()
        ]);        
    }

    /**
     * @Route("/sign_out", name="sign_out")
     */
    public function sign_out() {}
}
