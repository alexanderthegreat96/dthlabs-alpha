<?php
namespace LexSystems\Core\System\Extend;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Factory as ValidatorFactory;
use LexSystems\Core\System\Helpers\CoreUtils\Utils;
use LexSystems\Core\System\Helpers\Requests;
use Illuminate\Translation\Translator;
use Illuminate\Translation\MessageSelector;

class Validation
{
    /**
     * @param array $rules
     * @param array $messages
     * @param string $iso
     * @return array|bool[]
     * //        $rules = array(
    //            'username' => ['required', 'min:3', 'max:20'],
    //            'password' => ['required', 'min:5', 'max:60']
    //        );
    //        $messages = array(
    //            'username.required' => 'Username is required.',
    //            'username.min' => 'Username must be at least :min characters.',
    //            'username.max' => 'Username must be no more than :max characters.',
    //            'password.required' => 'Password is required.',
    //            'password.min' => 'Password must be at least :min characters.',
    //            'password.max' => 'Password must be no more than :max characters.',
    //        );
     */
    public static function validate(array $rules = [], array $messages = [] , bool $decodeErrors = true, string $iso = 'en')
    {
        $requests = new Requests();
        $arguments = $requests->getArguments();
        $transPath = __DIR__.'../../../resources/lang/';
        $translationFileLoader = new \Illuminate\Translation\FileLoader(new \Illuminate\Filesystem\Filesystem, $transPath);
        $translator = new \Illuminate\Translation\Translator($translationFileLoader,$iso);
        $validatorFactory = new \Illuminate\Validation\Factory($translator);


        if($arguments['post'])
        {
            $validator = $validatorFactory->make($arguments['post'], $rules,$messages);
            if($validator->fails())
            {
                $errors = $decodeErrors ? Utils::fromJson($validator->messages()) : $validator->messages();
                return ['status' => false,'error' => $errors];
            }
            else
            {
                return ['status' => true];
            }
        }
        else
        {
            return ['status' => false,'error' => 'No post request supplied'];
        }
    }
}