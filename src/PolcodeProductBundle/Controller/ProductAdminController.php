<?php

namespace PolcodeProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use PolcodeProductBundle\Entity\Product;
use PolcodeProductBundle\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ProductAdminController extends Controller {

	/**
	 * @Route("/products", name="products_list");
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();
	
		$entities = $em->getRepository('PolcodeProductBundle:Product')->findAll();
	
		return $this->render('PolcodeProductBundle:Product:index.html.twig', array(
			'entities' => $entities,
		));
	}
	
    /**
     * @Route("/product/edit/{product}", name="product_edit");
     */
    public function editAction(Product $product)
    {
        $em = $this->getDoctrine()->getManager();

        if (!$product) {
            throw new NotFoundHttpException();
        }

		$form = $this->createForm(new ProductType(), $product, array(
            'action' => $this->generateUrl('product_edit', array('product' => $product->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $this->render('PolcodeProductBundle:Product:edit.html.twig', array(
            'entity'  => $product,
            'edit_form' => $form->createView()
        ));
    }
	
    /**
     * @Route("/product/new", name="product_new");
     */
    public function newAction(Request $request)
    {
    	$entity = new Product();
    	
    	$form = $this->createForm(new ProductType(), $entity, array(
    			'action' => $this->generateUrl('product_new'),
    			'method' => 'POST',
    	));
    	$form->add('submit', 'submit', array('label' => 'Create'));
    	
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($entity);
    		$em->flush();
    	
    		return $this->redirect($this->generateUrl('product_show', array('slug' => $entity->getSlug())));
    	}
    	
    	return $this->render('PolcodeProductBundle:Product:new.html.twig', array(
    		'entity' => $entity,
    		'form' => $form->createView()
    	));
    }
    
    /**
     * @Route("/product/delete/{product}", name="product_delete");
     */
    public function deleteAction(Product $product)
    {
        $em = $this->getDoctrine()->getManager();

		if(!$this->getUser()->hasRole('ROLE_SUPER_ADMIN')) {
			throw new AccessDeniedHttpException();
		}
		
		$em->remove($product);
		$em->flush();

        return $this->redirect('products_list');
    }
	
    /**
     * @Route("/product/{lang}/{slug}", name="product_lang");
     */
    public function langAtion($lang, $slug)
    {
		$em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PolcodeProductBundle:Product')->findOneBy(['slug' => $slug]);
        
        if($entity == null) {
        	throw new NotFoundHttpException();
        }
        
        foreach($entity->getTranslations() as $trans) {
			if($trans->getLocale() == $lang)
        		return $this->render('PolcodeProductBundle:Product:lang.html.twig', array(
        			'entity' => $entity,
        			'trans' => $trans
        		));
        }

        throw new NotFoundHttpException();
    }
	
    /**
     * @Route("/product/{slug}", name="product_show");
     */
    public function showAction($slug)
    {
		$em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PolcodeProductBundle:Product')->findOneBy(['slug' => $slug]);
        
        if($entity == null) {
        	throw new NotFoundHttpException();
        }

        return $this->render('PolcodeProductBundle:Product:show.html.twig', array(
            'entity' => $entity,
        ));
    }
    
}
