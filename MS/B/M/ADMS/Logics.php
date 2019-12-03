<?php
namespace B\ADMS;

class Logics{

    public static function getTypeOfDocumentFromId($UniqId){

        \MS\Core\Helper\Comman::DB_flush();
        $m1 =new \B\ADMS\Model(2);
        return $m1->where('UniqId',$UniqId)->get()->first()->toArray();


    }

    public static function getTypeofDocuments(){
        \MS\Core\Helper\Comman::DB_flush();
        $m1 =new \B\ADMS\Model(2);
        return $m1->MS_all()->get()->pluck('NameOfDocuments','UniqId')->toArray();


    }


    public static function  getcreated_at($date){

        return  \Carbon::parse($date)->toDayDateTimeString();


    }

    public static function  getupdated_at($date){

        return  \Carbon::parse($date)->toDayDateTimeString();


    }

    public static function getNameOfDocument($name){


       return $name;
    }



}