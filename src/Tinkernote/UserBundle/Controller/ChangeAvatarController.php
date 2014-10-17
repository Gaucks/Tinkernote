<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tinkernote\UserBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Tinkernote\UserBundle\Entity\Avatar;

class ChangeAvatarController extends Controller{

    public function changeAvatarAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();

        $user_avatar_id = $user->getAvatar();

        $avatar = ($user_avatar_id->getId() == 1 )? new Avatar(): $user_avatar_id;

        $form = $this->createFormBuilder($avatar)
                     ->add('file')
                     ->getForm();

        if($request->isMethod('POST')){

            $form->handleRequest($request);

            if ($form->isValid()){

                $avatar->setDate(new \DateTime('now'));
                $em->persist($avatar);
                $em->flush();

                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $userManager = $this->get('fos_user.user_manager');
                $userManager->updateUser($user->setAvatar($avatar));

                $response = $this->redirect($this->generateUrl('user_change_avatar'));

                return $response;
            }
        }

        return $this->render('UserBundle:ChangeAvatar:changeAvatar.html.twig', array(
            'form' => $form->createView()
        ));
    }
}