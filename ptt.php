<?php
class gonderiSorgu {
   public $input;
}

class WSGeneralResponseDVO {
   public $serviceResponseId;
   public $serviceResponseDescription;

}

class Input extends WSGeneralResponseDVO {
   public $sifre;
   public $kullanici;
   public $barkod;
}

class Ptt {
   public function gonderiSorgu ($barkod = "") {
      try {
         $url = "https://pttws.ptt.gov.tr/GonderiTakipV2/services/Sorgu?wsdl";
         $input = new Input();
         $input->barkod = $barkod;
         $input->kullanici = "";
         $input->sifre = "";
         $inputson = new gonderiSorgu();
         $inputson->input = $input;

         $client = new SoapClient(
            $url,
            array(
               "ltrace" => 1,
               "cache_wsdl" => WSDL_CACHE_NONE,
               "exceptions" => true,
               "connection_timeout" => 30
            )
         );

         $client->__setLocation('https://pttws.ptt.gov.tr/GonderiTakipV2/services/Sorgu*');

         $response = $client->gonderiSorgu($inputson);

         return $response->return;

      } catch (Exception $e) {
         echo "<pre>";
         print_r ($e);
         echo "</pre>";
         return false;
      }
   }
}