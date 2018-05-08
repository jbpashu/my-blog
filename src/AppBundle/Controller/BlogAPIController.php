<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\RouteRedirectView;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controller to manage blog API contents.
 *
 * @Route("api/blogs")
 */
class BlogAPIController extends FOSRestController {

    /**
     * get blog list
     *
     * This function returns list of blog
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "When No Blog found"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @Route("/list.{_format}")
     * @Method("GET")
     * @return array returns array containing blog details
     *
     */
    public function getBlogListAction(Request $request, $_format) {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findLatestBlogPosts();

        $view = View::create();

        if ($posts) {
            $view->setStatusCode(200)->setData($posts)->setFormat($_format);
        } else {
            $view->setStatusCode(404)->setData(['errorMessage' => 'No Posts found']);
        }

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    /**
     * Get single blog post detaild by id
     *
     * @Route("/posts/{id}/info.{_format}")
     * @Method("GET")
     *
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "When No Blog details found"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @return array returns array containing blog details
     *
     */
    public function getPostAction(Post $post) {
        $view = View::create();
        if ($post->getIsActive()) {
            $post->setViews($post->getViews() + 1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $view->setStatusCode(200)->setData($post)->setFormat('json');
        } else {
            $view->setStatusCode(404)->setData(['errorMessage' => 'Posts does not exist']);
        }

        return $this->get('fos_rest.view_handler')->handle($view);
    }

}
