<?php

use Illuminate\Support\Facades\DB;

/**
 * Logs do banco de dados
 */
if(! function_exists('dbLogs')) {
    function dbLogs($action, $description = '') {

        $action = strtoupper(unaccent($action));

        \App\Models\Log::create([
            'user_id'     => auth()->user()->id,
            'ip'          => $_SERVER['REMOTE_ADDR'],
            'action'      => $action,
            'description' => $description,
            'user_agent'  => $_SERVER['HTTP_USER_AGENT'],
            'url'         => $_SERVER['REQUEST_URI']
        ]);
    }
}


/*
    Converte caracteres especiais em caracteres simples(ASCII).
    Exemplos: ç > c, á > a, Á > A, etc...
    https://gist.github.com/robertopc/9cebde3c21f2bd8b417c
*/
if(! function_exists('unaccent')) {

    function unaccent($string) {
        $characters = array(
            " " /* 00a0 'NO-BREAK SPACE'                             */ => " ",
            "¡" /* 00a1 'INVERTED EXCLAMATION MARK'                  */ => "!",
            "¢" /* 00a2 'CENT SIGN'                                  */ => "c",
            "£" /* 00a3 'POUND SIGN'                                 */ => "",
            "¤" /* 00a4 'CURRENCY SIGN'                              */ => "",
            "¥" /* 00a5 'YEN SIGN'                                   */ => "Y",
            "¦" /* 00a6 'BROKEN BAR'                                 */ => "|",
            "§" /* 00a7 'SECTION SIGN'                               */ => "",
            "¨" /* 00a8 'DIAERESIS'                                  */ => "",
            "©" /* 00a9 'COPYRIGHT SIGN'                             */ => "(c)",
            "ª" /* 00aa 'FEMININE ORDINAL INDICATOR'                 */ => "",
            "«" /* 00ab 'LEFT-POINTING DOUBLE ANGLE QUOTATION MARK'  */ => "",
            "¬" /* 00ac 'NOT SIGN'                                   */ => "",
            "­"  /* 00ad 'SOFT HYPHEN'                                */ => "",
            "®" /* 00ae 'REGISTERED SIGN'                            */ => "(r)",
            "¯" /* 00af 'MACRON'                                     */ => "",
            "°" /* 00b0 'DEGREE SIGN'                                */ => "",
            "±" /* 00b1 'PLUS-MINUS SIGN'                            */ => "+/-",
            "²" /* 00b2 'SUPERSCRIPT TWO'                            */ => "2",
            "³" /* 00b3 'SUPERSCRIPT THREE'                          */ => "3",
            "´" /* 00b4 'ACUTE ACCENT'                               */ => "",
            "µ" /* 00b5 'MICRO SIGN'                                 */ => "u",
            "¶" /* 00b6 'PILCROW SIGN'                               */ => "",
            "·" /* 00b7 'MIDDLE DOT'                                 */ => ".",
            "¸" /* 00b8 'CEDILLA'                                    */ => ",",
            "¹" /* 00b9 'SUPERSCRIPT ONE'                            */ => "1",
            "º" /* 00ba 'MASCULINE ORDINAL INDICATOR'                */ => "",
            "»" /* 00bb 'RIGHT-POINTING DOUBLE ANGLE QUOTATION MARK' */ => ">>",
            "¼" /* 00bc 'VULGAR FRACTION ONE QUARTER'                */ => "1/4",
            "½" /* 00bd 'VULGAR FRACTION ONE HALF'                   */ => "1/2",
            "¾" /* 00be 'VULGAR FRACTION THREE QUARTERS'             */ => "3/4",
            "¿" /* 00bf 'INVERTED QUESTION MARK'                     */ => "?",
            "À" /* 00c0 'LATIN CAPITAL LETTER A WITH GRAVE'          */ => "A",
            "Á" /* 00c1 'LATIN CAPITAL LETTER A WITH ACUTE'          */ => "A",
            "Â" /* 00c2 'LATIN CAPITAL LETTER A WITH CIRCUMFLEX'     */ => "A",
            "Ã" /* 00c3 'LATIN CAPITAL LETTER A WITH TILDE'          */ => "A",
            "Ä" /* 00c4 'LATIN CAPITAL LETTER A WITH DIAERESIS'      */ => "A",
            "Å" /* 00c5 'LATIN CAPITAL LETTER A WITH RING ABOVE'     */ => "A",
            "Æ" /* 00c6 'LATIN CAPITAL LETTER AE'                    */ => "AE",
            "Ç" /* 00c7 'LATIN CAPITAL LETTER C WITH CEDILLA'        */ => "C",
            "È" /* 00c8 'LATIN CAPITAL LETTER E WITH GRAVE'          */ => "E",
            "É" /* 00c9 'LATIN CAPITAL LETTER E WITH ACUTE'          */ => "E",
            "Ê" /* 00ca 'LATIN CAPITAL LETTER E WITH CIRCUMFLEX'     */ => "E",
            "Ë" /* 00cb 'LATIN CAPITAL LETTER E WITH DIAERESIS'      */ => "E",
            "Ì" /* 00cc 'LATIN CAPITAL LETTER I WITH GRAVE'          */ => "I",
            "Í" /* 00cd 'LATIN CAPITAL LETTER I WITH ACUTE'          */ => "I",
            "Î" /* 00ce 'LATIN CAPITAL LETTER I WITH CIRCUMFLEX'     */ => "I",
            "Ï" /* 00cf 'LATIN CAPITAL LETTER I WITH DIAERESIS'      */ => "I",
            "Ð" /* 00d0 'LATIN CAPITAL LETTER ETH'                   */ => "ETH",
            "Ñ" /* 00d1 'LATIN CAPITAL LETTER N WITH TILDE'          */ => "N",
            "Ò" /* 00d2 'LATIN CAPITAL LETTER O WITH GRAVE'          */ => "O",
            "Ó" /* 00d3 'LATIN CAPITAL LETTER O WITH ACUTE'          */ => "O",
            "Ô" /* 00d4 'LATIN CAPITAL LETTER O WITH CIRCUMFLEX'     */ => "O",
            "Õ" /* 00d5 'LATIN CAPITAL LETTER O WITH TILDE'          */ => "O",
            "Ö" /* 00d6 'LATIN CAPITAL LETTER O WITH DIAERESIS'      */ => "O",
            "×" /* 00d7 'MULTIPLICATION SIGN'                        */ => "x",
            "Ø" /* 00d8 'LATIN CAPITAL LETTER O WITH STROKE'         */ => "O",
            "Ù" /* 00d9 'LATIN CAPITAL LETTER U WITH GRAVE'          */ => "U",
            "Ú" /* 00da 'LATIN CAPITAL LETTER U WITH ACUTE'          */ => "U",
            "Û" /* 00db 'LATIN CAPITAL LETTER U WITH CIRCUMFLEX'     */ => "U",
            "Ü" /* 00dc 'LATIN CAPITAL LETTER U WITH DIAERESIS'      */ => "U",
            "Ý" /* 00dd 'LATIN CAPITAL LETTER Y WITH ACUTE'          */ => "Y",
            "Þ" /* 00de 'LATIN CAPITAL LETTER THORN'                 */ => "TH",
            "ß" /* 00df 'LATIN SMALL LETTER SHARP S'                 */ => "S",
            "à" /* 00e0 'LATIN SMALL LETTER A WITH GRAVE'            */ => "a",
            "á" /* 00e1 'LATIN SMALL LETTER A WITH ACUTE'            */ => "a",
            "â" /* 00e2 'LATIN SMALL LETTER A WITH CIRCUMFLEX'       */ => "a",
            "ã" /* 00e3 'LATIN SMALL LETTER A WITH TILDE'            */ => "a",
            "ä" /* 00e4 'LATIN SMALL LETTER A WITH DIAERESIS'        */ => "a",
            "å" /* 00e5 'LATIN SMALL LETTER A WITH RING ABOVE'       */ => "a",
            "æ" /* 00e6 'LATIN SMALL LETTER AE'                      */ => "ae",
            "ç" /* 00e7 'LATIN SMALL LETTER C WITH CEDILLA'          */ => "c",
            "è" /* 00e8 'LATIN SMALL LETTER E WITH GRAVE'            */ => "e",
            "é" /* 00e9 'LATIN SMALL LETTER E WITH ACUTE'            */ => "e",
            "ê" /* 00ea 'LATIN SMALL LETTER E WITH CIRCUMFLEX'       */ => "e",
            "ë" /* 00eb 'LATIN SMALL LETTER E WITH DIAERESIS'        */ => "e",
            "ì" /* 00ec 'LATIN SMALL LETTER I WITH GRAVE'            */ => "i",
            "í" /* 00ed 'LATIN SMALL LETTER I WITH ACUTE'            */ => "i",
            "î" /* 00ee 'LATIN SMALL LETTER I WITH CIRCUMFLEX'       */ => "i",
            "ï" /* 00ef 'LATIN SMALL LETTER I WITH DIAERESIS'        */ => "i",
            "ð" /* 00f0 'LATIN SMALL LETTER ETH'                     */ => "eth",
            "ñ" /* 00f1 'LATIN SMALL LETTER N WITH TILDE'            */ => "n",
            "ò" /* 00f2 'LATIN SMALL LETTER O WITH GRAVE'            */ => "o",
            "ó" /* 00f3 'LATIN SMALL LETTER O WITH ACUTE'            */ => "o",
            "ô" /* 00f4 'LATIN SMALL LETTER O WITH CIRCUMFLEX'       */ => "o",
            "õ" /* 00f5 'LATIN SMALL LETTER O WITH TILDE'            */ => "o",
            "ö" /* 00f6 'LATIN SMALL LETTER O WITH DIAERESIS'        */ => "o",
            "÷" /* 00f7 'DIVISION SIGN'                              */ => "/",
            "ø" /* 00f8 'LATIN SMALL LETTER O WITH STROKE'           */ => "o",
            "ù" /* 00f9 'LATIN SMALL LETTER U WITH GRAVE'            */ => "u",
            "ú" /* 00fa 'LATIN SMALL LETTER U WITH ACUTE'            */ => "u",
            "û" /* 00fb 'LATIN SMALL LETTER U WITH CIRCUMFLEX'       */ => "u",
            "ü" /* 00fc 'LATIN SMALL LETTER U WITH DIAERESIS'        */ => "u",
            "ý" /* 00fd 'LATIN SMALL LETTER Y WITH ACUTE'            */ => "y",
            "þ" /* 00fe 'LATIN SMALL LETTER THORN'                   */ => "th",
            "ÿ" /* 00ff 'LATIN SMALL LETTER Y WITH DIAERESIS'        */ => "y",
            "Ā" /* 0100 'LATIN CAPITAL LETTER A WITH MACRON'         */ => "A",
            "ā" /* 0101 'LATIN SMALL LETTER A WITH MACRON'           */ => "a",
            "Ă" /* 0102 'LATIN CAPITAL LETTER A WITH BREVE'          */ => "A",
            "ă" /* 0103 'LATIN SMALL LETTER A WITH BREVE'            */ => "a",
            "Ą" /* 0104 'LATIN CAPITAL LETTER A WITH OGONEK'         */ => "A",
            "ą" /* 0105 'LATIN SMALL LETTER A WITH OGONEK'           */ => "a",
            "Ć" /* 0106 'LATIN CAPITAL LETTER C WITH ACUTE'          */ => "C",
            "ć" /* 0107 'LATIN SMALL LETTER C WITH ACUTE'            */ => "c",
            "Ĉ" /* 0108 'LATIN CAPITAL LETTER C WITH CIRCUMFLEX'     */ => "C",
            "ĉ" /* 0109 'LATIN SMALL LETTER C WITH CIRCUMFLEX'       */ => "c",
            "Ċ" /* 010a 'LATIN CAPITAL LETTER C WITH DOT ABOVE'      */ => "C",
            "ċ" /* 010b 'LATIN SMALL LETTER C WITH DOT ABOVE'        */ => "c",
            "Č" /* 010c 'LATIN CAPITAL LETTER C WITH CARON'          */ => "C",
            "č" /* 010d 'LATIN SMALL LETTER C WITH CARON'            */ => "c",
            "Ď" /* 010e 'LATIN CAPITAL LETTER D WITH CARON'          */ => "D",
            "ď" /* 010f 'LATIN SMALL LETTER D WITH CARON'            */ => "d",
            "Đ" /* 0110 'LATIN CAPITAL LETTER D WITH STROKE'         */ => "D",
            "đ" /* 0111 'LATIN SMALL LETTER D WITH STROKE'           */ => "d",
            "Ē" /* 0112 'LATIN CAPITAL LETTER E WITH MACRON'         */ => "E",
            "ē" /* 0113 'LATIN SMALL LETTER E WITH MACRON'           */ => "e",
            "Ĕ" /* 0114 'LATIN CAPITAL LETTER E WITH BREVE'          */ => "E",
            "ĕ" /* 0115 'LATIN SMALL LETTER E WITH BREVE'            */ => "e",
            "Ė" /* 0116 'LATIN CAPITAL LETTER E WITH DOT ABOVE'      */ => "E",
            "ė" /* 0117 'LATIN SMALL LETTER E WITH DOT ABOVE'        */ => "e",
            "Ę" /* 0118 'LATIN CAPITAL LETTER E WITH OGONEK'         */ => "E",
            "ę" /* 0119 'LATIN SMALL LETTER E WITH OGONEK'           */ => "e",
            "Ě" /* 011a 'LATIN CAPITAL LETTER E WITH CARON'          */ => "E",
            "ě" /* 011b 'LATIN SMALL LETTER E WITH CARON'            */ => "e",
            "Ĝ" /* 011c 'LATIN CAPITAL LETTER G WITH CIRCUMFLEX'     */ => "G",
            "ĝ" /* 011d 'LATIN SMALL LETTER G WITH CIRCUMFLEX'       */ => "g",
            "Ğ" /* 011e 'LATIN CAPITAL LETTER G WITH BREVE'          */ => "G",
            "ğ" /* 011f 'LATIN SMALL LETTER G WITH BREVE'            */ => "g",
            "Ġ" /* 0120 'LATIN CAPITAL LETTER G WITH DOT ABOVE'      */ => "G",
            "ġ" /* 0121 'LATIN SMALL LETTER G WITH DOT ABOVE'        */ => "g",
            "Ģ" /* 0122 'LATIN CAPITAL LETTER G WITH CEDILLA'        */ => "G",
            "ģ" /* 0123 'LATIN SMALL LETTER G WITH CEDILLA'          */ => "g",
            "Ĥ" /* 0124 'LATIN CAPITAL LETTER H WITH CIRCUMFLEX'     */ => "H",
            "ĥ" /* 0125 'LATIN SMALL LETTER H WITH CIRCUMFLEX'       */ => "h",
            "Ħ" /* 0126 'LATIN CAPITAL LETTER H WITH STROKE'         */ => "H",
            "ħ" /* 0127 'LATIN SMALL LETTER H WITH STROKE'           */ => "h",
            "Ĩ" /* 0128 'LATIN CAPITAL LETTER I WITH TILDE'          */ => "I",
            "ĩ" /* 0129 'LATIN SMALL LETTER I WITH TILDE'            */ => "i",
            "Ī" /* 012a 'LATIN CAPITAL LETTER I WITH MACRON'         */ => "I",
            "ī" /* 012b 'LATIN SMALL LETTER I WITH MACRON'           */ => "i",
            "Ĭ" /* 012c 'LATIN CAPITAL LETTER I WITH BREVE'          */ => "I",
            "ĭ" /* 012d 'LATIN SMALL LETTER I WITH BREVE'            */ => "i",
            "Į" /* 012e 'LATIN CAPITAL LETTER I WITH OGONEK'         */ => "I",
            "į" /* 012f 'LATIN SMALL LETTER I WITH OGONEK'           */ => "i",
            "İ" /* 0130 'LATIN CAPITAL LETTER I WITH DOT ABOVE'      */ => "I",
            "ı" /* 0131 'LATIN SMALL LETTER DOTLESS I'               */ => "i",
            "Ĳ" /* 0132 'LATIN CAPITAL LIGATURE IJ'                  */ => "IJ",
            "ĳ" /* 0133 'LATIN SMALL LIGATURE IJ'                    */ => "ij",
            "Ĵ" /* 0134 'LATIN CAPITAL LETTER J WITH CIRCUMFLEX'     */ => "J",
            "ĵ" /* 0135 'LATIN SMALL LETTER J WITH CIRCUMFLEX'       */ => "j",
            "Ķ" /* 0136 'LATIN CAPITAL LETTER K WITH CEDILLA'        */ => "K",
            "ķ" /* 0137 'LATIN SMALL LETTER K WITH CEDILLA'          */ => "k",
            "ĸ" /* 0138 'LATIN SMALL LETTER KRA'                     */ => "kra",
            "Ĺ" /* 0139 'LATIN CAPITAL LETTER L WITH ACUTE'          */ => "L",
            "ĺ" /* 013a 'LATIN SMALL LETTER L WITH ACUTE'            */ => "l",
            "Ļ" /* 013b 'LATIN CAPITAL LETTER L WITH CEDILLA'        */ => "L",
            "ļ" /* 013c 'LATIN SMALL LETTER L WITH CEDILLA'          */ => "l",
            "Ľ" /* 013d 'LATIN CAPITAL LETTER L WITH CARON'          */ => "L",
            "ľ" /* 013e 'LATIN SMALL LETTER L WITH CARON'            */ => "l",
            "Ŀ" /* 013f 'LATIN CAPITAL LETTER L WITH MIDDLE DOT'     */ => "L",
            "ŀ" /* 0140 'LATIN SMALL LETTER L WITH MIDDLE DOT'       */ => "l",
            "Ł" /* 0141 'LATIN CAPITAL LETTER L WITH STROKE'         */ => "L",
            "ł" /* 0142 'LATIN SMALL LETTER L WITH STROKE'           */ => "l",
            "Ń" /* 0143 'LATIN CAPITAL LETTER N WITH ACUTE'          */ => "N",
            "ń" /* 0144 'LATIN SMALL LETTER N WITH ACUTE'            */ => "n",
            "Ņ" /* 0145 'LATIN CAPITAL LETTER N WITH CEDILLA'        */ => "N",
            "ņ" /* 0146 'LATIN SMALL LETTER N WITH CEDILLA'          */ => "n",
            "Ň" /* 0147 'LATIN CAPITAL LETTER N WITH CARON'          */ => "N",
            "ň" /* 0148 'LATIN SMALL LETTER N WITH CARON'            */ => "n",
            "ŉ" /* 0149 'LATIN SMALL LETTER N PRECEDED BY APOSTROPHE'*/ => "'n",
            "Ŋ" /* 014a 'LATIN CAPITAL LETTER ENG'                   */ => "ENG",
            "ŋ" /* 014b 'LATIN SMALL LETTER ENG'                     */ => "eng",
            "Ō" /* 014c 'LATIN CAPITAL LETTER O WITH MACRON'         */ => "O",
            "ō" /* 014d 'LATIN SMALL LETTER O WITH MACRON'           */ => "o",
            "Ŏ" /* 014e 'LATIN CAPITAL LETTER O WITH BREVE'          */ => "O",
            "ŏ" /* 014f 'LATIN SMALL LETTER O WITH BREVE'            */ => "o",
            "Ő" /* 0150 'LATIN CAPITAL LETTER O WITH DOUBLE ACUTE'   */ => "O",
            "ő" /* 0151 'LATIN SMALL LETTER O WITH DOUBLE ACUTE'     */ => "o",
            "Œ" /* 0152 'LATIN CAPITAL LIGATURE OE'                  */ => "OE",
            "œ" /* 0153 'LATIN SMALL LIGATURE OE'                    */ => "oe",
            "Ŕ" /* 0154 'LATIN CAPITAL LETTER R WITH ACUTE'          */ => "R",
            "ŕ" /* 0155 'LATIN SMALL LETTER R WITH ACUTE'            */ => "r",
            "Ŗ" /* 0156 'LATIN CAPITAL LETTER R WITH CEDILLA'        */ => "R",
            "ŗ" /* 0157 'LATIN SMALL LETTER R WITH CEDILLA'          */ => "r",
            "Ř" /* 0158 'LATIN CAPITAL LETTER R WITH CARON'          */ => "R",
            "ř" /* 0159 'LATIN SMALL LETTER R WITH CARON'            */ => "r",
            "Ś" /* 015a 'LATIN CAPITAL LETTER S WITH ACUTE'          */ => "S",
            "ś" /* 015b 'LATIN SMALL LETTER S WITH ACUTE'            */ => "s",
            "Ŝ" /* 015c 'LATIN CAPITAL LETTER S WITH CIRCUMFLEX'     */ => "S",
            "ŝ" /* 015d 'LATIN SMALL LETTER S WITH CIRCUMFLEX'       */ => "s",
            "Ş" /* 015e 'LATIN CAPITAL LETTER S WITH CEDILLA'        */ => "S",
            "ş" /* 015f 'LATIN SMALL LETTER S WITH CEDILLA'          */ => "s",
            "Š" /* 0160 'LATIN CAPITAL LETTER S WITH CARON'          */ => "S",
            "š" /* 0161 'LATIN SMALL LETTER S WITH CARON'            */ => "s",
            "Ţ" /* 0162 'LATIN CAPITAL LETTER T WITH CEDILLA'        */ => "T",
            "ţ" /* 0163 'LATIN SMALL LETTER T WITH CEDILLA'          */ => "t",
            "Ť" /* 0164 'LATIN CAPITAL LETTER T WITH CARON'          */ => "T",
            "ť" /* 0165 'LATIN SMALL LETTER T WITH CARON'            */ => "t",
            "Ŧ" /* 0166 'LATIN CAPITAL LETTER T WITH STROKE'         */ => "T",
            "ŧ" /* 0167 'LATIN SMALL LETTER T WITH STROKE'           */ => "t",
            "Ũ" /* 0168 'LATIN CAPITAL LETTER U WITH TILDE'          */ => "U",
            "ũ" /* 0169 'LATIN SMALL LETTER U WITH TILDE'            */ => "u",
            "Ū" /* 016a 'LATIN CAPITAL LETTER U WITH MACRON'         */ => "U",
            "ū" /* 016b 'LATIN SMALL LETTER U WITH MACRON'           */ => "u",
            "Ŭ" /* 016c 'LATIN CAPITAL LETTER U WITH BREVE'          */ => "U",
            "ŭ" /* 016d 'LATIN SMALL LETTER U WITH BREVE'            */ => "u",
            "Ů" /* 016e 'LATIN CAPITAL LETTER U WITH RING ABOVE'     */ => "U",
            "ů" /* 016f 'LATIN SMALL LETTER U WITH RING ABOVE'       */ => "u",
            "Ű" /* 0170 'LATIN CAPITAL LETTER U WITH DOUBLE ACUTE'   */ => "U",
            "ű" /* 0171 'LATIN SMALL LETTER U WITH DOUBLE ACUTE'     */ => "u",
            "Ų" /* 0172 'LATIN CAPITAL LETTER U WITH OGONEK'         */ => "U",
            "ų" /* 0173 'LATIN SMALL LETTER U WITH OGONEK'           */ => "u",
            "Ŵ" /* 0174 'LATIN CAPITAL LETTER W WITH CIRCUMFLEX'     */ => "W",
            "ŵ" /* 0175 'LATIN SMALL LETTER W WITH CIRCUMFLEX'       */ => "w",
            "Ŷ" /* 0176 'LATIN CAPITAL LETTER Y WITH CIRCUMFLEX'     */ => "Y",
            "ŷ" /* 0177 'LATIN SMALL LETTER Y WITH CIRCUMFLEX'       */ => "y",
            "Ÿ" /* 0178 'LATIN CAPITAL LETTER Y WITH DIAERESIS'      */ => "Y",
            "Ź" /* 0179 'LATIN CAPITAL LETTER Z WITH ACUTE'          */ => "Z",
            "ź" /* 017a 'LATIN SMALL LETTER Z WITH ACUTE'            */ => "z",
            "Ż" /* 017b 'LATIN CAPITAL LETTER Z WITH DOT ABOVE'      */ => "Z",
            "ż" /* 017c 'LATIN SMALL LETTER Z WITH DOT ABOVE'        */ => "z",
            "Ž" /* 017d 'LATIN CAPITAL LETTER Z WITH CARON'          */ => "Z",
            "ž" /* 017e 'LATIN SMALL LETTER Z WITH CARON'            */ => "z",
            "ſ" /* 017f 'LATIN SMALL LETTER LONG S'                  */ => "s",
        );
        return strtr($string, $characters);
    }
}