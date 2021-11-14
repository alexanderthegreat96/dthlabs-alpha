<?php
namespace LexSystems\Framework\Controllers;
use LexSystems\Framework\Kernel\Controller;
use Gherkins\RegExpBuilderPHP\RegExpBuilder;
use LexSystems\Framework\Kernel\Helpers\Arrays\ArrayUtility;
use LexSystems\Framework\Kernel\Helpers\Debugger\Debugger;
use Symfony\Component\VarDumper\VarDumper;
class MyController extends Controller
{
    public function indexAction()
    {

        $inputs =
            [
                [
                    'id' => 'nume',
                    'type' => 'text',
                    'label' => 'Nume',
                    'name' => 'first_name',
                    'required' => 'true'
                ],
                [
                    'id' => 'prenume',
                    'type' => 'text',
                    'label' => 'Prenume',
                    'name' => 'last_name',
                    'required' => 'true'
                ],
                [
                    'id' => 'telefon',
                    'type' => 'number',
                    'label' => 'Telefon',
                    'name' => 'phone',
                    'required' => 'true'
                ],
                [
                    'id' => 'localitate',
                    'type' => 'text',
                    'label' => 'Localitate',
                    'name' => 'city',
                    'required' => 'true'
                ],
                [
                    'id' => 'judet',
                    'type' => 'text',
                    'label' => 'Judet',
                    'name' => 'state',
                    'required' => 'true'
                ],
                [
                    'id' => 'strada',
                    'type' => 'text',
                    'label' => 'Strada',
                    'name' => 'street',
                    'required' => 'true'
                ],
                [
                    'id' => 'numar',
                    'type' => 'number',
                    'label' => 'Numar',
                    'name' => 'number',
                    'required' => 'true'
                ],
                [
                    'id' => 'bloc_scara_apartament',
                    'type' => 'text',
                    'label' => 'Bloc/Scara/Apartament',
                    'name' => 'bloc_sc_ap',
                    'required' => 'true'
                ],
                [
                    'id' => 'zip',
                    'type' => 'number',
                    'label' => 'Cod Postal',
                    'name' => 'zip_code',
                    'required' => 'true'
                ],
                [
                    'id' => 'save',
                    'type' => 'submit',
                    'label' => '',
                    'name' => 'submit',
                    'value' => 'Save'
                ]

            ];

        $this->dd(ArrayUtility::array_group_by($inputs,'label'));

        $this->view()->renderTemplate('index',[]);
//        $this->dd(['myVar' => 'Something','somethingRequest' => $this->request()->hasArgument('something')]);

    }
}
