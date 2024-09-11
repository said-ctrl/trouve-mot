<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class GameController extends AbstractController
{
    #[Route('/', name: '')]


    public function index(Request $request, SessionInterface $session): Response
    {
        $sons = [
            [
                'title' => 'Madrina',
                'artist' => 'Maes Booba',
                'lyrics' => "j'ai fait des caddies pour la pièce '",
                'missing' => "j'ai ... ... ... ... la ...",

            ],
            [
                'title' => 'Bling Bling',
                'artist' => 'kaaris',
                'lyrics' => "Tant mieux si t'as un trop gros boule, j'ai le permis camion ",
                'missing' => "Tant ... si t'as un ... ... ..., j'ai ... ... ...",

            ],
            [
                'title' => 'Pochon Bleu',
                'artist' => 'Naps',
                'lyrics' => "J'ai pris de mon grand frère à ce qu'il paraît j'ai la même tête",
                'missing' => "J'ai ... de mon ... ... à ce qu'il paraît j'... ... ... ...",

            ],
            [
                'title' => "Moi j'ai pas",
                'artist' => 'Soprano',
                'lyrics' => "Ni la femme de Jay-Z Moi j'ai pas les dents en or de Joey",
                'missing' => " de Jay-Z Moi j'ai pas les ",

            ],
            [
                'title' => 'libertine',
                'artist' => 'Mylen farmer',
                'lyrics' => "je suis libertine Je suis une catin Je, je suis si fragile Qu'on me tienne la main ",
                'missing' => "je suis ... Je suis ... ... Je, je suis ... ...Qu'on me tienne la main",

            ],

        ];


     
    
        // Sélectionner une chanson aléatoire
       
        $session->set('selected_son', $sons[rand(0, count($sons) - 1)]);
        $selectedson = $session->get('selected_son');

        // Diviser les paroles et les mots manquants
        $mots = explode(" ", $selectedson['lyrics']);
        $motmanquant = explode(" ", $selectedson['missing']);

        // Initialiser les mots devinés et le score
        $mots_devines = $session->get('mots_devines', array_fill(0, count($mots), '...'));
        $score = $session->get('score', 100);

        // Récupérer la réponse du joueur
        $reponsejoueur = $request->request->get('reponse');
        $message = "";

        if ($reponsejoueur) {
            $mottrouve = false;
            foreach ($mots as $index => $mot) {
                if (strtolower($reponsejoueur) === strtolower($mot)) {
                    $mots_devines[$index] = $mot;
                    $mottrouve = true;
                }
            }

            if (!$mottrouve) {
                $score -= 10;
                $message = "Mot incorrect. -10 points.";
            } else {
                $message = "Bien joué ! Continuez à deviner.";
            }

            $session->set('mots_devines', $mots_devines);
            $session->set('score', $score);

            if (!in_array('...', $mots_devines)) {
                $message = "Félicitations ! Vous avez trouvé toute la phrase avec un score de " . $score . " points.";
            }
        }

        return $this->render('game/index.html.twig', [
            'mots_devines' => $mots_devines,
            'missing' => implode(" ", $motmanquant),
            'title' => $selectedson['title'],
            'artist' => $selectedson['artist'],
            'message' => $message,
            'score' => $score,
        ]);
    }
}


    


 