<?php

if (!function_exists('phone_validate')) {

    function phone_validate($phone) {
        $libphone = \libphonenumber\PhoneNumberUtil::getInstance();
        try{
            $r_phone = $libphone->parse($phone, null);
        } catch (Exception $ex) {
            return null;
        }
        if(!$libphone->isValidNumber($r_phone)){
            return null; 
        }
        return $libphone->format($r_phone, \libphonenumber\PhoneNumberFormat::E164);
    }

}

if(!function_exists('phone_validate_mobile')){
    function phone_validate_mobile($phone){
        $libphone = \libphonenumber\PhoneNumberUtil::getInstance();
        try{
            $r_phone = $libphone->parse($phone, null);
        } catch (Exception $ex) {
            return null;
        }
        if(!$libphone->isValidNumber($r_phone)){
            return null; 
        }
        if($libphone->getNumberType($r_phone) != \libphonenumber\PhoneNumberType::MOBILE){
            return null;
        }
        return $libphone->format($r_phone, \libphonenumber\PhoneNumberFormat::E164);
    }
}