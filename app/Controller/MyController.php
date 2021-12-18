<?php
namespace LexSystems\Framework\Controllers;
use LexSystems\Framework\Kernel\Controller;
use LexSystems\Framework\Kernel\Helpers\Debugger\Debugger;
use LexSystems\Framework\Models\MyData;
class MyController extends Controller
{
    public function indexAction()
    {
        Debugger::var_dump($this->request->getArguments());

        /**
         * Data insert test
         */

//        $data = new MyData();
//        $data->first_name = 'Smith';
//        $data->last_name = 'Paul';
//        $data->company_name = 'Microsoft';
//        $data->car_make = 'Audi';
//        $data->car_model = 'A6';
//
//        $data->save();

//        Debugger::var_dump(MyData::create(
//            [
//                'first_name'  => 'Deontay',
//                'last_name' => 'Wilder',
//                'company_name' => 'UFC',
//                'car_make' => 'Lamborghini',
//                'car_model' => 'Urus'
//            ]
//        ));
        /**
         * Data fetch test
         */



//        foreach (MyData::all() as $item)
//        {
//            echo $item->first_name."<br/>";
//        }


        /**
         * Call eloquent ORM query builder
         */
        $my_data = $this->db::table('my_data');
        Debugger::var_dump($my_data->get());


    }
}
