<?php
     /**
     * PHP Version 7.2.19 or newer
     * Functions for website subscriber
     * 
     * @category    File
     * @package     Cashier
     * @author     Nkuke Henry
     * @copyright   henricsanyu@gmail.com
     */

    namespace App\Http\Controllers\Payment;

    
    use Exception;
    use Twocheckout;
    use Twocheckout_Charge;

    class CashierController 
    {
        public static function pay($paymentInfo)
        {
            Twocheckout::privateKey(env('2CHECKOUT_PRIVATE_KEY'));
            Twocheckout::sellerId(env('2CHECKOUT_SELLER_ID'));
            env('2CHECKOUT_ENVIROMENT') == 'production' ?  Twocheckout::sandbox(false) :  Twocheckout::sandbox(true);
            env('2CHECKOUT_ENVIROMENT') == 'production' ?  Twocheckout::verifySSL(true) :  Twocheckout::verifySSL(false);
            

            try 
            {
                $charge = Twocheckout_Charge::auth($paymentInfo);

                if ($charge['response']['responseCode'] == 'APPROVED') 
                {
                    return ['success' => true, 'message' => $charge];
                } 
            }
            catch(Exception $e)
            {   
                return ['success' => false, 'message' => $e->getMessage()];
            }
            return ['success'=> false, 'message'=>'Something went wrong when trying to pay!'];
        }
    }