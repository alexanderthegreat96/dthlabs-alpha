<?php
namespace LexSystems\Core\System\Extend;
use LexSystems\Core\System\Helpers\Sesssions\Session;
use Mobicms\Captcha as MakeCaptcha;

class Captcha
{
    /**
     * @param int $length
     * @param int $maxLength
     * @return MakeCaptcha\Code[]
     */
    public static function makeCode(int $length = 5, int $maxLength = 7)
    {
        $session = new Session();

        try
        {
            $code = new MakeCaptcha\Code($length,$maxLength);
            return
                [
                'status' => true,
                'code' => $code->generate()
                ];
        }
        catch (\Exception $e)
        {
            return
                [
                    'status' => false,
                    'error' => $e->getMessage()
                ];
        }
    }

    /**
     * @param string $code
     * @param array $options
     * @return MakeCaptcha\Image[]
     */
    public static function makeImage(string $code = '')
    {
        try
        {
            $options = new MakeCaptcha\Options();
            $options->setFontsFolder(__DIR__.'/../../../resources/fonts/');
            $options->setImageSize(275, 125);
            $image = new MakeCaptcha\Image($code,$options);
            return ['status' => true, 'img_src' => $image->generate()];
        }
        catch (\Exception $e)
        {
            return ['status' => false,'error' => $e->getMessage()];
        }

    }
}