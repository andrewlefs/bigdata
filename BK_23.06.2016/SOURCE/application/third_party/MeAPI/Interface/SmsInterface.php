<?php

/* @var $cache_user CI_Cache */
interface MeAPI_Interface_SmsInterface extends MeAPI_Response_ResponseInterface {
    public function receive_mo(MeAPI_RequestInterface $request) ;
}
