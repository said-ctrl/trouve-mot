<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GameController extends AbstractController
{
    #[Route('/', name: 'game_index')]


    public function index(Request $request): Response
    {
        $phrases = [
            [
                'title' => 'Madrina',
                'author' => 'Maes Booba',
                'text' => "La madrina voudrait la bague au doigt
Les flics au cul, j'cours dans la tess
J'ai fait des caddies pour la pièce
J'vendrais de la hess ou quoi ou qu'est-ce
Au revoir, merci Madame la hess
J'suis dans ma nouvelle caisse
J'suis dans ma nouvelle kehba
J'suis dans ma nouvelle guerre
J'suis dans de nouvelles lères-ga
Je roule en Ferrari, j'ai pas besoin de guer-dra
J'suis très mauvais mari, j'ai le cœur à Bagheera
Le monde est à moi comme l'ami de Manny
Je garde mon sang froid comme rate-pi du Mali
Les coups de feu sont partis sans aucune empathie
Je crois que j'vais tout casser, j'n'aime pas ce qu'ils ont bâti",
                // 'missing' => "j'ai ... ... ... ... la ...",

            ],
            [
                'title' => 'Bling Bling',
                'author' => 'kaaris',
                'text' => "Tant mieux si t'as un trop gros boule
J'ai le permis camion
Elle a cent millilitres de liquide dans la culotte
Elle peut meme plus prendre l'avion
Si tu me cherches, ne sois pas bête
Tape mon blaze sur ta tablette
Je serai neuf millimètres
Tu ne seras plus, donc fuck Hamlet
Je t'ai eu tu le sais skinny, désolé ma belle
Si c'est pour me dire que c'est fini
T'aurais pu me le dire au phone-tél
Si t'es une puta, si t'es un teur-men
Gare aux débordements, débordements, débordements
Je veux une chicha goût the-men
Je garde le comportement, comportement, comportement",
                // 'missing' => "Tant ... si t'as un ... ... ..., j'ai ... ... ...",

            ],
            [
                'title' => 'Pochon Bleu',
                'author' => 'Naps',
                'text' => "On est comme des petits pit' frérot nous on lâche pas le coup
J'ai pris de mon grand frère a ce qui paraît j'ai la même tête
Je veux toujours le dernier mot j'ai un drôle de caractère
Qu'est ce ta tu m'invente des trucs
Je quitte mon poste je m'en bas les couilles
Qui veut tej je lui crache des douilles je passerai jamais à la fouille
Je suis à la tour 1 je vais à la tour 2 récupérer youssef et on se taille à la tour 3
350 en shit 250 en beuh juste après je vais me caler avec une gadji à la tour 4
Du biggy du 2pac je suis pété ouai sous jack
Dès que les coups partent j'ai une tête de coupable",
                // 'missing' => "J'ai ... de mon ... ... à ce qu'il paraît j'... ... ... ...",

            ],
            [
                'title' => "Moi j'ai pas",
                'author' => 'Soprano',
                'text' => "Moi j'ai pas la culture d'AKH
Ni la plume de Oxmo
Ni la culture du double H
Moi j'ai pas la créatine de Fifty
Ni la femme de Jay-Z
Moi j'ai pas les dents en or de Joey
Ni le round de Kool Shen
Ni la MPC de Dr.Dre
Moi j'ai pas la lipo de Missy
Moi j'ai oas les bleus de Mélanie
Moi j'ai pas eu les menottes à Sinik
Moi j'ai pas le côté hardcore du Tandematique
Moi j'ai pas la véracité de Kerry
Ni la barbe de Médine
Moi j'ai pas ...",
                // 'missing' => " de Jay-Z Moi j'ai pas les ",

            ],
            [
                'title' => 'libertine',
                'author' => 'Mylen farmer',
                'text' => "Cendre de lune, petite bulle d'écume Poussée par le vent, je brûle et je m'enrhume
Entre mes dunes reposent mes infortunes
C'est nue, que j'apprends la vertu
Je, je suis libertine
Je suis une catin
Je, je suis si fragile
Qu'on me tienne la main
Fendre la lune, baisers d'épine et de plume
Bercée par un petit vent, je déambule
La vie est triste comme un verre de grenadine
Aimer c'est pleurer quand on s'incline
Je, je suis libertine
Je suis une catin
Je, je suis si fragile
Qu'on me tienne la main",
                // 'missing' => "je suis ... Je suis ... ... Je, je suis ... ...Qu'on me tienne la main",

            ],

        ];
    
        $selectedPhrase = $phrases[array_rand($phrases)];
        $selectedPhrase['hiddenWords'] = $this->getRandomWords($selectedPhrase['text'], 5);
    
        $selectedPhrase['maskedText'] = $this->maskText($selectedPhrase['text'], $selectedPhrase['hiddenWords']);

        return $this->render('game/index.html.twig', [
            'phrase' => $selectedPhrase,
        ]);
    }

    private function getRandomWords(string $text, int $count): array
    {
        $words = array_unique(str_word_count($text, 1));
        $words = array_filter($words, function ($word) {
            return strlen($word) > 3;
        });

        shuffle($words);
        return array_slice($words, 0, $count);
    }

    private function maskText(string $text, array $hiddenWords): string
    {
        foreach ($hiddenWords as $word) {
            $text = str_replace($word, str_repeat('_', strlen($word)), $text);
        }
        return $text;
    }
}






















    //  programme de base 
    
//         // Sélectionner une chanson aléatoire
       
//         $session->set('selected_son', $sons[rand(0, count($sons) - 1)]);
//         $selectedson = $session->get('selected_son');

//         // Diviser les paroles et les mots manquants
//         $mots = explode(" ", $selectedson['lyrics']);
//         $motmanquant = explode(" ", $selectedson['missing']);

//         // Initialiser les mots devinés et le score
//         $mots_devines = $session->get('mots_devines', array_fill(0, count($mots), '...'));
//         $score = $session->get('score', 100);

//         // Récupérer la réponse du joueur
//         $reponsejoueur = $request->request->get('reponse');
//         $message = "";

//         if ($reponsejoueur) {
//             $mottrouve = false;
//             foreach ($mots as $index => $mot) {
//                 if (strtolower($reponsejoueur) === strtolower($mot)) {
//                     $mots_devines[$index] = $mot;
//                     $mottrouve = true;
//                 }
//             }

//             if (!$mottrouve) {
//                 $score -= 10;
//                 $message = "Mot incorrect. -10 points.";
//             } else {
//                 $message = "Bien joué ! Continuez à deviner.";
//             }

//             $session->set('mots_devines', $mots_devines);
//             $session->set('score', $score);

//             if (!in_array('...', $mots_devines)) {
//                 $message = "Félicitations ! Vous avez trouvé toute la phrase avec un score de " . $score . " points.";
//             }
//         }

//         return $this->render('game/index.html.twig', [
//             'mots_devines' => $mots_devines,
//             'missing' => implode(" ", $motmanquant),
//             'title' => $selectedson['title'],
//             'artist' => $selectedson['artist'],
//             'message' => $message,
//             'score' => $score,
//         ]);
//     }
// }
