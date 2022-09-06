<?php
 
namespace App\Helpers;

class CustomResponse
{
    public static function button(string $class="", string $text="", array $parameters){
        $parameters = self::decodeParameters($parameters);
        return "<button class='btn btn-$class mr-1' $parameters> $text </button>";
    }

    public static function decodeParameters(array $parameters){
        $string = "";

        foreach ($parameters as $key => $value) {
            $string .= "$key='$value'";
        }

        return $string;
    }
}