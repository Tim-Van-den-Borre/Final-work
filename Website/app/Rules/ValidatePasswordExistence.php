<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidatePasswordExistence implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $chars = substr(strtoupper(hash('sha1', $value)), 0, 5);

        $originalHash = strtoupper(hash('sha1', $value));

        $url = "https://api.pwnedpasswords.com/range/" . strval($chars);

        $client = new \GuzzleHttp\Client();

        $request = $client->get($url, ['verify' => false]);

        $response = $request->getBody();

        $response = explode("\n", $response);

        foreach($response as $value){
            $responseValues = explode(":", $value);
            $combination = $chars . $responseValues[0];
            if($combination == $originalHash && $responseValues[1] > 300){
                error_log($responseValues[1]);
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The password exists more then 300 times.';
    }
}
