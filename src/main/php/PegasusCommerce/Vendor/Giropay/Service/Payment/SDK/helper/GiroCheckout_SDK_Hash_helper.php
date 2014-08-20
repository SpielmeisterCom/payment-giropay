<?php
/**
 * Helper class which manages hash generation
 *
 * @package GiroCheckout
 * @version $Revision: 24 $ / $Date: 2014-05-22 14:30:12 +0200 (Do, 22 Mai 2014) $
 */

class GiroCheckout_SDK_hash_helper {

    /*
     * returns a HMAC Hash with md5 encryption by using a secret and an array
     *
     * @param String password
     * @param mixed[] data to hash
     * @return String generated hash
     */
    public static function getHMACMD5Hash($password, $data)
    {
        $dataString = implode('', $data);

        return self::getHMACMD5HashString($password, $dataString);
    }

    /*
     * returns a HMAC Hash with md5 encryption by using a secret and a string
     *
     * @param String password
     * @param String data to hash
     * @return String generated hash
     */
    public static function getHMACMD5HashString($password, $data)
    {
      if(function_exists('hash_hmac')) {
        return hash_hmac('MD5', $data,$password);
      }
      else {
        return self::hmacFallbackMD5($data, $password);
      }
    }

    /*
     * returns a HMAC Hash with md5 encryption by using a secret
     * Fallback if no hmac() support  <PHP5.1.2
     *
     * @param String password
     * @param mixed[] data to hash
     * @return String generated hash
     */
    private static function hmacFallbackMD5 ($data, $secret) {
        $b = 64; // byte length for md5

        if (strlen($secret) > $b) {
            $secret = pack("H*",md5($secret));
        }

        $secret = str_pad($secret, $b, chr(0x00));
        $ipad = str_pad('', $b, chr(0x36));
        $opad = str_pad('', $b, chr(0x5c));
        $k_ipad = $secret ^ $ipad ;
        $k_opad = $secret ^ $opad;

        return md5($k_opad . pack("H*",md5($k_ipad . $data)));
    }
}