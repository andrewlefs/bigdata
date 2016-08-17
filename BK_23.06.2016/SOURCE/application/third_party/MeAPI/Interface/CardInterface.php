<?php

/* @var $cache_user CI_Cache */
interface MeAPI_Interface_CardInterface extends MeAPI_Response_ResponseInterface {
    public function paycard(MeAPI_RequestInterface $request) ;
}
