<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/2/15
 * Time: 6:09 PM
 */

namespace app;
 
use epii\admin\ui\EpiiAdminUi;
use epii\app\controller;
use epii\server\Args;

class epii_phone_upload extends controller
 {
        public   function index()
        { 
             ob_start();
          $file_types = Args::params("file_types/1");
          include_once __DIR__."/../view/index.php";
            $conetnt = ob_get_clean();
             EpiiAdminUi::showPage($conetnt);
        }
 }