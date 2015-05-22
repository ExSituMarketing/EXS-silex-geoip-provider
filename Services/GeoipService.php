<?php

namespace EXS\GeoipProvider\Services;

use MaxMind\Db\Reader;

/**
 * Gets the country from User's IP
 *
 * Created 1-May-2015
 * @author Damien Demessence <damiend@ex-situ.com>
 * @copyright   Copyright 2015 ExSitu Marketing.
 */
class GeoIPService
{
    /**
     * The database with IP/Countries
     * @param string $databaseFile
     */
    public function __construct($databaseFile='')
    {
        $this->databaseFile = $databaseFile;
    }
    
    /**
     * Gets the country code.
     *
     * @param string $ipAddress
     *            the IP address to look up.
     * @return string the country Iso3166Alpha2 code
     */
    public function getGeoipCountryCode($ipAddress=''){ 
        try{
            if (function_exists('geoip_country_code_by_name')) {
                $country = geoip_country_code_by_name($ipAddress);
            } else {
                $country = $this->getCountryByReader($ipAddress)['country']['iso_code'];
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return $country;
    }
    /**
     * Gets the country GeoIP2
     *
     * @param string $ipAddress
     *            the IP address to look up.
     * @return array the record for the IP address.
     */
    public function getCountryByReader($ipAddress=''){
        $reader = new Reader($this->databaseFile);
        $country = $reader->get($ipAddress);
        $reader->close();
        return $country;
    }
}
