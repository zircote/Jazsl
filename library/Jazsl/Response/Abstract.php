<?php
class Jazsl_Response_Abstract
{
    public function __construct ($xml)
    {
    }
    public function process (SimpleXMLElement $xml)
    {
        $result = array();
        $name = $xml->getName();
        if ($name == 'rowset') {
            $data = $this->rowSet($xml);
            foreach ($data as $rK => $rV) {
                $result[$rK] = $rV;
            }
        } else {
            $result[$name] = array();
            foreach ($xml->attributes() as $key => $value) {
                $result[$name][(string) $key] = (string) $value;
            }
            if ($xml->count() > 0) {
                foreach ($xml->children() as $child) {
                    foreach ($this->process($child) as $cK => $cV) {
                        $result[$name][$cK] = $cV;
                    }
                }
            } else {
                $result[$name] = (string) $xml;
                foreach ($xml->attributes() as $key => $att) {
                    $result[$name][(string) $key] = (string) $att;
                }
            }
        }
        return $result;
    }
}