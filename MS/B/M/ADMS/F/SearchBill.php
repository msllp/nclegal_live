<?php
/**
 * Created by PhpStorm.
 * User: Mitul
 * Date: 11-12-2018
 * Time: 12:31 PM
 */

namespace B\ADMS\F;


class SearchBill
{

    public static function byAgencyCode($AgencyCode){

       // dd($AgencyCode);

        \MS\Core\Helper\Comman::DB_flush();
        $m3=new \B\ADMS\Model(1);
        $allIBillTable=array_flip(\DB::connection($m3->getConnectionName())->getDoctrineSchemaManager()->listTableNames());
        $outData=[];
        $model=[];
        foreach ($allIBillTable as $key=>$value) {

            $tableExo = explode('_', $key);
            $agencyCode=$tableExo[2];
            $agentCode=implode('_', [  $tableExo[2],  $tableExo[3] ]);
            $taskCode= $tableExo[4];
            $taskCodeArray[]=$taskCode;
            $agentCodeArray[]=$agentCode;
           // dd();
            if( $agencyCode == $AgencyCode){

                if (! array_key_exists( $taskCode,$outData )) {
                   \ MS\Core\Helper\Comman::DB_flush();
                    $m1=new \B\ADMS\Model(1,implode('_',[$agentCode,$taskCode]));
                    $model[]=$m1->where('id','>','0')->orderByDesc('created_at')->paginate(500);
                    // dd($m1->where('id','>','0')->orderByDesc('created_at')->paginate(500));
                    //$outData[$taskCode] =
                    }
            }

        }




        if(count($model) > 0){






            $diplayArray=[

                'UniqId'=>'Documeny ID',

                //'TypeOfDocument'=>'Trip Code',

                'NameOfDocument'=>'Name of Document',
                'AmountOfDocument'=>'Amount',

                'created_at'=>'Upload Date',
               // 'updated_at'=>'Last Update'


            ];

            $link=[

                // 'delete'=>[
                // 	'method'=>'TMS.Task.Delete.Id',
                // 	'key'=>'UniqId',

                // ],

                 'ms-action'=>[
                 	'method'=>'ADMS.Get.Upload.File',
                 	'key'=>'UniqId',
//                   'DBFunda'=>[
//                   ],
                  'icon'=>'fa fa-download',
                   'iconFileType'=>'auto',
                     //'displayText'=>'Download',
                 'extraClassData'=>[
                        'btn-color'=>'btn-default',
                     'btn-text-color'=>'ms-text-black',

                 ],
                'downloadFile'=>true
                 ],

//
//                'view'=>[
//                    'method'=>'LOC.Location.TripBy.UniqId',
//                    'key'=>'TripCode',
//
//                ],



            ];


            foreach ($model as $key=>$value ){
                $msOld=$link['ms-action'];
                $link['ms-action']['DBFunda']=[

                    'raw'=>[

                        'LedgerId'=>\MS\Core\Helper\Comman::en4url ( implode('_',[ $agentCodeArray [$key],$taskCodeArray[$key]] ) ),
                        'fileId'=> ['UniqId'],
                    ],
//                    'rawKey'=>
//                        \MS\Core\Helper\Comman::en4url ( implode('_',[$taskCodeArray[$key], $agentCodeArray [$key]] ) )
//                        ,
//                    'rawKeyName'=>'LedgerId',
                ];
                                // dd($taskCodeArray[$key]);
                $taskRaw=\B\TMS\Logics::getTaskRaw($taskCodeArray[$key],true);

           

               $titleArray= [

                    'Task Code: '.$taskCodeArray[$key],
                    'Name of Piracy Network: '.$taskRaw['NameOperator'],
                    'Name of Owner: '.$taskRaw['NameOwner'],
                    'Agent: '.\B\AAMS\Logics::getAgentCode($agentCodeArray[$key]) ." (".$agentCodeArray[$key].")"
                ];
                $title=implode(" , ",$titleArray);
               // dd(\B\AAMS\Logics::getAgentCode($agentCodeArray[$key]));
                $build=new \MS\Core\Helper\Builder ("B\ADMS");

                $build->title($title)->listData($value)->listView($diplayArray)
                    ->addListAction($link);
                    //dd();
                     // $build->heading( 'Agent: '.\B\AAMS\Logics::getAgentCode($agentCodeArray[$key]) ." (".$agentCodeArray[$key].")");
              //  $rData[]="<h4> ".$agentCodeArray[$key]."</h4>";
                $rData[]=$build->view(true,'list');
                $link['ms-action']=$msOld;
            }




            return  implode(' ',$rData);
        }



    }
}