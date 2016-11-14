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
class GeoipService
{
    /**
     * Path to GeoIp Database file
     * @var string
     */
    protected $databaseFile;
    
    /**
     * Country fallback in case Ip is unknown
     * @var string
     */
    protected $countryFallback;
    
    /**
     * The database with IP/Countries
     * @param string $databaseFile
     */
    public function __construct($databaseFile='',$countryFallback='us')
    {
        $this->databaseFile = $databaseFile;
        $this->countryFallback = $countryFallback;
    }
    
    /**
     * Gets the country code.
     *
     * @param string $ipAddress
     *            the IP address to look up.
     * @return string the country Iso3166Alpha2 code
     */
    public function getGeoipCountryCode($ipAddress=''){ 
        $iso_code = $this->readIpAddress($ipAddress);
        if($iso_code){
            return $iso_code;
        } else {
            return $this->countryFallback;
        }
    }
    /**
     * Get the country code from the IP.
     *
     * @param string $ipAddress
     *            the IP address to look up.
     * @return string the country Iso3166Alpha2 code or null
     */
    public function readIpAddress($ipAddress=''){
        $iso_code = null;
        try{
            if (function_exists('geoip_country_code_by_name')) {
                $iso_code = geoip_country_code_by_name($ipAddress);
            } else {
                $country = $this->getCountryByReader($ipAddress);
                if(isset($country['country']['iso_code'])) {
                    $iso_code = $country['country']['iso_code'];
                }
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return $iso_code;
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