<?php

namespace Viewflex\Tiny\Utility;


class Encoder
{
    const HASH_CHARACTERS = array(
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    /**
     * Generates hash for $id using Base62 encoding.
     * 
     * @param int $id
     * @return string|null
     */
    public function encode($id) {
        $hash = '';
        $hashDigits = array();
        $dividend = (int) $id;

        while ($dividend > 0) {
            $remainder = floor($dividend % 62);
            $dividend = floor($dividend / 62);
            array_unshift($hashDigits, $remainder);
        }

        foreach ($hashDigits as $v) {
            $hash .= self::HASH_CHARACTERS[$v];
        }

        return $hash;
    }
    
}
