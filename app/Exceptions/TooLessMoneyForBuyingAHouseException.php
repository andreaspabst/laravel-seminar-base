<?php

namespace App\Exceptions;

use Exception;

class TooLessMoneyForBuyingAHouseException extends Exception
{
    /**
     * Description of FunctionName
     * @param Type Parameter
     * @return void
     */
    public function render($request) {
        return response('Kein Geld gefunden', 404);
    }

    /**
     * Description of FunctionName
     * @param Type Parameter
     * @return void
     */
    public function report() {

    }
}
