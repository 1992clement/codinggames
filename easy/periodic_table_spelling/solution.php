<?php
    $word = strtolower(stream_get_line(STDIN, 30 + 1, "\n"));
    $letters = str_split($word);
    $elements = getMatchingElements($letters);

    $spellings = buildWords($elements, $word, $letters);

    if (empty($spellings)) {
        echo "none\n";
    } else {
        for ($i = 0; $i < count($spellings); $i++) {
            echo "$spellings[$i]\n";
        }
    }

    function getMatchingElements(array $letters) {
        $periodic = 'H He Li Be B C N O F Ne Na Mg Al Si P S Cl Ar K Ca Sc Ti V Cr Mn Fe Co Ni Cu Zn Ga Ge As Se Br Kr Rb Sr Y Zr Nb Mo Tc Ru Rh Pd Ag Cd In Sn Sb Te I Xe Cs Ba La Ce Pr Nd Pm Sm Eu Gd Tb Dy Ho Er Tm Yb Lu Hf Ta W Re Os Ir Pt Au Hg Tl Pb Bi Po At Rn Fr Ra Ac Th Pa U Np Pu Am Cm Bk Cf Es Fm Md No Lr Rf Db Sg Bh Hs Mt Ds Rg Cn Nh Fl Mc Lv Ts Og';
        $elements = array_combine(explode(' ', strtolower($periodic)), explode(' ', $periodic));
        $matchingElements = [];

        for($i = 0; $i < count($letters); $i++) {
            if (isset($elements[$letters[$i]])) {
                $matchingElements[$letters[$i]] = $elements[$letters[$i]];
            }
            if (isset($letters[$i+1]) && isset($elements[$letters[$i].$letters[$i+1]])) {
                $matchingElements[$letters[$i].$letters[$i+1]] = $elements[$letters[$i].$letters[$i+1]];
            }
        }

        return $matchingElements;
    }

    function buildWords(
        array $elements, 
        string $targetWord, 
        array $letters, 
        string $currentWord = '', 
        int $index = 0, 
        array $results = []
    ) {
        // We spelt the correct word
        if (strtolower($currentWord) === strtolower($targetWord)) {
            $results[] = $currentWord;

            return $results;
        }

        // No match, can't spell further, stop looping
        if (!isset($elements[$letters[$index]]) 
            && !(isset($letters[$index+1]) && isset($elements[$letters[$index].$letters[$index+1]]))) {
            return $results;
        }

        // Match for next 1 letter
        if (isset($elements[$letters[$index]])) {
            $next = $currentWord.$elements[$letters[$index]];
            $results = buildWords($elements, $targetWord, $letters, $next, $index+1, $results);
        }

        // Match for next 2 letters
        if (isset($letters[$index+1]) && isset($elements[$letters[$index].$letters[$index+1]])) {
            $next = $currentWord.$elements[$letters[$index].$letters[$index+1]];
            $results = buildWords($elements, $targetWord, $letters, $next, $index+2, $results);
        } 

        return $results;
    }
?>