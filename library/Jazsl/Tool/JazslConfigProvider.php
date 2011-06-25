<?php

require_once ('Jazsl/Tool/JazslProviderAbstract.php');


class Jazsl_Tool_JazslConfigProvider extends Jazsl_Tool_JazslProviderAbstract
{
    public function uploadConfig($zendserver)
    {
        $this->setZendserver($zendserver);

    }
    public function downloadConfig($zendserver)
    {
        $this->setZendserver($zendserver);

    }
}