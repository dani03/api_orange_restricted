<?php

namespace App\Http\Requests\Commandes;

use App\Enums\OptionSecureServer;
use App\Enums\Os;
use App\Enums\Status;
use App\Enums\Technology;
use Doctrine\Inflector\Rules\French\Rules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommandeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $serverStrikeOptions = Os::allStatusLabel();
        $secureServerOptions = OptionSecureServer::allStatusLabel();
        return [
            'numberLicence' => ['required', 'numeric'],
            'description' => ['max:3000'],
            'client_identifier' => ['required', 'integer', Rule::exists('clients', 'id')],
            'offre_identifier' => ['required', 'integer', Rule::exists('offres', 'id')],
            'status' => ['required', 'integer', Rule::in(Status::allStatusValues())],
            // étant donné qu'une commande peut avoir une ou plusieurs technologies on attend donc un tableau
            'technology' => [Rule::exists('technologies', 'name'),
                'required', 'array'],
            'option_technology' => [
                'array',
                // on applique les règles sur les choix possibles
                function ($attribute, $values, $fail) use ($serverStrikeOptions, $secureServerOptions) {
                    //on récupere la valeur des technologies choisies
                    $technologiesChoose = request('technology');
                    //on parcourt les options choisies afin de vérifier si elles correspondent aux technologies choisies
                    foreach ($values as $value) {
                        // si la valeur n'est dans aucun tableau
                        if (!in_array($value, $serverStrikeOptions, true) && !in_array($value, $secureServerOptions, true)) {
                            $fail(" l'option $value n'existe pas");

                        }
                        //on verifie si l'option fait partie des options de serverStrike choisies
                        if (in_array($value, $serverStrikeOptions, true)) {
                            //on verifie si la technologie fait partie des technologies choisies
                            $serverStrike = Technology::serverStrikeLabel();
                            // si la technologie ne fait pas partie des technos choisies on renvoie une erreur
                            if (!in_array($serverStrike, $technologiesChoose, true)) {
                                $fail("L'option $value ne fait pas partis des options pour cette technologie les options possible : " . implode(',', $secureServerOptions));
                            }
                        }
                        //  on effectue la meme chose pour l'autre choix
                        if (in_array($value, $secureServerOptions, true)) {
                            //on verifie si la technologie fait partie des technologies choisies
                            $secureServer = Technology::secureServerLabel();
                            // si la technologie ne fait pas partie des technos choisies on renvoie une erreur
                            if (!in_array($secureServer, $technologiesChoose, true)) {
                                $fail("L'option choisie ne fait pas parti des choix possible, les choix : " . implode(',', $serverStrikeOptions));

                            }
                        }


                    }


                },
            ],


        ];
    }
}
