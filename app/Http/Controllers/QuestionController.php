<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Session;
use App\Models\Question;
use Illuminate\Validation\Rule;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Http\Resources\SessionResource;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all('id','question_text','question_type','options');

        foreach ($questions as $question) {
            $question->options = $this->convertJsonToArray($question->options);
        }
        return response()->json($questions);
    }

    private function convertJsonToArray($jsonString)
{
    $array = json_decode($jsonString, true);

    if (json_last_error() === JSON_ERROR_NONE) {
        return $array;
    }

    return null;
}
public function store(Request $request)
{
    // Générer un identifiant de session unique
    $sessionId = Uuid::uuid4()->toString();



     // Valider les données soumises par l'utilisateur
     $validator = Validator::make($request->all(), [
        'responses.*.question_id' => 'required|integer',
        'responses.*.response_value' => [
            'required',
            function ($attribute, $value, $fail) {
                $question = Question::find($value['question_id']);

                if ($question->question_type === 'number') {
                    if (!is_numeric($value['response_value'])) {
                        $fail('La réponse doit être un nombre pour la question de type "number".');
                    }
                } elseif ($question->question_type === 'radio') {
                    if (empty($value['response_value'])) {
                        $fail('Veuillez sélectionner au moins une option pour la question de type "radio".');
                    }
                }
            },
        ],
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Créer une nouvelle session
    $session = Session::create(['session_id' => $sessionId]);


    // Récupérer les réponses soumises par l'utilisateur depuis le formulaire
    $responses = $request->json()->all();

    // Enregistrer chaque réponse dans la base de données avec l'identifiant de session associé
    foreach ($responses as $response) {
        Response::create([
            'session_id' => $session->id,
            'question_id' => $response['question_id'],
            'response_value' => $response['response_value'],
        ]);
    }

    // Rediriger l'utilisateur vers une autre page ou afficher un message de succès
    return response()->json(['message' => 'Réponses enregistrées avec succès', 'session_id'=>$session], 200);
}






public function getResponses(Request $request)
{
    $sessionId = $request->session_id;

    // Récupérer la session spécifiée par l'ID
    $session = Session::where('session_id', $sessionId)->first();

    if (!$session) {
        // La session n'existe pas
        return response()->json(['message' => 'Session introuvable'], 404);
    }

    // Récupérer les réponses associées à la session avec les relations
    $responses = $session->responses()->with('question')->get();

    // Construire la structure de réponse contenant les informations requises
    $responseData = $responses->map(function ($response) {
        return [
            'question_id' => $response->question_id,
            'response_value' => $response->response_value,
            'question_type' => $response->question->question_type,
            'question_text' => $response->question->question_text,
        ];
    });

    return response()->json($responseData);
}



    public function getSession()
    {
        $sessions = Session::all('id','session_id');
        return SessionResource::collection($sessions);

       
        foreach ($sessions as $session) {

        $response[$session->session_id]=$session->responses()->get(['question_id','response_value']);

        }
        return response()->json($response);
    }


    public function getResponse()
    {
        $questions = Response::all('id','question_id','response_value');
        return response()->json($questions);
    }
}
