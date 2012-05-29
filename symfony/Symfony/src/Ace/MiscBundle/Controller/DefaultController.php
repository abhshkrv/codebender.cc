<?php

namespace Ace\MiscBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Ace\MiscBundle\Entity\BlogPost;

class developer
{
	public $name;
	public $image;
	public $description;
	function __construct($name, $subtext, $image, $description)
	{
		$this->name = $name;
		$this->subtext = $subtext;
		$this->image = $image;
		$this->description = $description;
	}
}

class DefaultController extends Controller
{

	public function aboutAction()
	{
		return $this->render('AceMiscBundle:Default:about.html.twig');
	}

	public function teamAction()
	{
		$tzikis_name = "Vasilis Georgitzikis";
		$tzikis_title = "teh lead";
		$tzikis_avatar = "http://www.gravatar.com/avatar/1a6a5289ac4473b5731fa9d9a3032828?s=260";
		$tzikis_desc = "I am a student at the Computer Engineering and Informatics Department of the University of Patras, Greece, a researcher at the Research Academic Computer Technology Institute, and an Arduino and iPhone/OSX/Cocoa developer. Basically, just a geek who likes building stuff, which is what started codebender in the first place.";
		$tzikis = new developer($tzikis_name, $tzikis_title, $tzikis_avatar, $tzikis_desc);

		$tsampas_name = "Stelios Tsampas";
		$tsampas_title = "teh crazor";
		$tsampas_avatar = "http://secure.gravatar.com/avatar/a5eb2b494a07a39ab0eef0d10aa86c84?s=260";
		$tsampas_desc="Yet another student at CEID. My task is to make sure to bring crazy ideas to the table and let others assess their value. I'm also responsible for the Arduino Ethernet TFTP bootloader, the only crazy idea that didn't originate from me. I also have a 'wierd' coding style that causes much distress to $tzikis_name.";
		$tsampas = new developer($tsampas_name, $tsampas_title, $tsampas_avatar, $tsampas_desc);

		$amaxilatis_name = "Dimitris Amaxilatis";
		$amaxilatis_title = "teh code monkey";
		$amaxilatis_avatar = "http://codebender.cc/images/amaxilatis.jpg";
		$amaxilatis_desc = "Master Student at the Computer Engineering and Informatics Department of the University of Patras, Greece. Researcher at  the Research Unit 1 of Computer Technology Institute & Press (Diophantus) in the fields of Distributed Systems and Wireless Sensor Networks.";
		$amaxilatis = new developer($amaxilatis_name, $amaxilatis_title, $amaxilatis_avatar, $amaxilatis_desc);

		$kousta_name = "Maria Kousta";
		$kousta_title = "teh lady";
		$kousta_avatar = "http://codebender.cc/images/kousta.png";
		$kousta_desc = "A CEID graduate. My task is to develop the various parts of the site besides the core 'code and compile' page that make it a truly social-building website.";
		$kousta = new developer($kousta_name, $kousta_title, $kousta_avatar, $kousta_desc);

		$orfanos_name = "Markellos Orfanos";
		$orfanos_title = "teh fireman";
		$orfanos_avatar = "http://codebender.cc/images/orfanos.jpg";
		$orfanos_desc = "I am also (not for long I hope) a student at the Computer Engineering & Informatics Department and probably the most important person in the team. My task? Make sure everyone keeps calm and the team is having fun. And yes, I'm the one who developed our wonderful options page. Apart from that, I'm trying to graduate and some time in the future to become a full blown Gentoo developer.";
		$orfanos = new developer($orfanos_name, $orfanos_title, $orfanos_avatar, $orfanos_desc);

		$developers = array($tzikis, $tsampas, $amaxilatis, $kousta, $orfanos);
		return $this->render('AceMiscBundle:Default:team.html.twig', array("developers" => $developers));
	}
	public function blogAction()
	{
		// $posts = $this->getDoctrine()->getRepository('AceMiscBundle:BlogPost')->findAll();

		$em = $this->getDoctrine()->getEntityManager();
		$qb = $em->createQueryBuilder();

		$qb->add('select', 'u')->add('from', 'AceMiscBundle:BlogPost u')->add('orderBy', 'u.date DESC');
		$posts = $qb->getQuery()->getResult();

		return $this->render('AceMiscBundle:Default:blog.html.twig', array("posts" => $posts));
	}

	public function blog_newAction()
	{
		if (false === $this->get('security.context')->isGranted('ROLE_ADMIN'))
		{
			throw new AccessDeniedException();
		}
		else
		{
			$title = $this->getRequest()->query->get('title');
			$text = $this->getRequest()->query->get('msgpost');
			$author = $this->container->get('security.context')->getToken()->getUser()->getUsername();
			$em = $this->getDoctrine()->getEntityManager();
			$post = new BlogPost();
			$post->setTitle($title);
			$post->setText($text);
			$post->setAuthor($author);
			$post->setDate(new \DateTime("now"));
			$em->persist($post);
			$em->flush();
			return $this->redirect($this->generateUrl('AceMiscBundle_blog'));
		}


	}

	public function tutorialsAction()
	{
		return $this->render('AceMiscBundle:Default:tutorials.html.twig');
	}
}
