<div class="ms-mod-tab">
<?php
    

    
    $uniqId=$data['AgentCode'];




            $id=6;
                \MS\Core\Helper\Comman::DB_flush();
        $build=new \MS\Core\Helper\Builder ($data['NameSpace']);
        \MS\Core\Helper\Comman::DB_flush();
        $build->title("Upload Document For Agent ID: ".$uniqId)->action("agentUploadPost",\MS\Core\Helper\Comman::en4url($uniqId))->btn([
                                'action'=>"\\B\\AAMS\\Controller@agentPanelData",
                                //'action-para'=>\MS\Core\Helper\Comman::en4url($uniqId),
                                'color'=>"btn-info",
                                'icon'=>"fa fa-fast-backward",
                                'text'=>"Back to Agent Panel"
                            ])->btn([
                                //'action'=>"\\B\\MAS\\Controller@addCCPost",
                                'color'=>"btn-success",
                                'icon'=>"fa fa-floppy-o",
                                'text'=>"Upload"
                            ])->js(["Core.js.Backend.Multiple","ATMS.J.UploadDocument"])->extraFrom($id,['title'=>'Attachments','multiple'=>true,'multipleAdd'=>true]);

        //dd($build);
        \MS\Core\Helper\Comman::DB_flush();
        echo $build->view()->render();


?>


</div>