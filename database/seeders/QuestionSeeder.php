<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::create([
            'question_text'=>"Votre adresse mail ?",
        ]);
        Question::create([
            'question_text'=>"Votre âge ?",
        ]);
        Question::create([
            'question_text'=>"Votre sexe ?",'question_type'=>'radio', 'options'=>json_encode( ['Homme', 'Femme', ' Préfère ne pas répondre'])

        ]);
        Question::create([
           'question_text'=>"Nombre de personnes dans votre foyer (adulte & enfants – répondant inclus) ?",'question_type'=>'number' ]);
       Question::create([
           'question_text'=>"Votre profession ?",
        ]);
        Question::create([
            'question_text'=>"Quelle marque de casque VR utilisez-vous ?",'question_type'=>'radio', 'options'=>json_encode( ["Oculus Quest", "Oculus Rift/s", "HTC Vive", "Windows Mixed Reality","Valve index"])

        ]);
        Question::create([
            'question_text'=>"Sur quel magasin d’application achetez-vous des contenus VR ?", 'question_type'=>'radio', 'options'=>json_encode(["SteamVR", "Occulus store", "Viveport", "Windows store"])

        ]);
        Question::create([
            'question_text'=>"Quel casque envisagez-vous d’acheter dans un futur proche ?",'question_type'=>'radio', 'options'=>json_encode( ["Occulus Quest", "Occulus Go", "HTC Vive Pro", "PSVR", "Autre", "Aucun"])

        ]);
        Question::create([
            'question_text'=>"Au sein de votre foyer, combien de personnes utilisent votre casque VR pour regarder Bigscreen ?",'question_type'=>'number' ]);
        Question::create([
            'question_text'=>"Vous utilisez principalement Bigscreen pour ?",'question_type'=>'radio', 'options'=>json_encode( ["regarder la TV en direct", "regarder des films", "travailler",
            "jouer en solo", "jouer en équipe"])

        ]);
         Question::create([
            'question_text'=> "Combien de points (de 1 à 5) donnez-vous à la qualité de l’image sur Bigscreen ?",'question_type'=>'number']);
         Question::create([
            'question_text'=> "Combien de points (de 1 à 5) donnez-vous au confort d’utilisation de l’interface Bigscreen ?",'question_type'=>'number']);
         Question::create([
            'question_text'=> "Combien de points (de 1 à 5) donnez-vous à la connexion réseau de Bigscreen ?",'question_type'=>'number' ]);
         Question::create([
            'question_text'=>"Combien de points (de 1 à 5) donnez-vous à la qualité des graphismes 3D dans Bigscreen ?",'question_type'=>'number']);
         Question::create([
            'question_text'=>"Combien de points (de 1 à 5) donnez-vous à la qualité audio dans Bigscreen ?", 'question_type'=>'number']);

        Question::create([
            'question_text'=>"Aimeriez-vous avoir des notifications plus précises au cours de vos sessions Bigscreen ?",'question_type'=>'radio', 'options'=>json_encode( ['Oui', 'Non']),

        ]);
        Question::create([
            'question_text'=>"Aimeriez-vous pouvoir inviter un ami à rejoindre votre session via son smartphone ?",'question_type'=>'radio', 'options'=>json_encode( ['Oui', 'non'])

        ]);
         Question::create([
            'question_text'=>"Aimeriez-vous pouvoir enregistrer des émissions TV pour pouvoir les regarder ultérieurement ?",'question_type'=>'radio', 'options'=>json_encode( ['Oui', 'non'])
        ]);
         Question::create([
            'question_text'=>"Aimeriez-vous jouer à des jeux exclusifs sur votre Bigscreen ?", 'question_type'=>'radio', 'options'=>json_encode( ['Oui', 'non'])]);


        Question::create([
            'question_text'=>"Selon vous, quelle nouvelle fonctionnalité devrait exister sur Bigscreen ?",
        ]);
    }
}
