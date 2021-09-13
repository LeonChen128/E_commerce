<?php

namespace App\Exceptions;

use Exception;

class Error extends Exception
{
    public function report()
    {
        // do something
    }

    public function render()
    {
        return response()->json(['message' => $this->getMessage()], 400);
    }
}