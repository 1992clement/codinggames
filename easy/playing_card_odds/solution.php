<?php
	fscanf(STDIN, "%d %d", $R, $S);
	
	$removedCards = [];
	$soughtCards = [];
	$deck = new Deck();
	$parser = new CardsParser();

	for ($i = 0; $i < $R; $i++)
	{
	    $removed = stream_get_line(STDIN, 15 + 1, "\n");
	    $removedCards = array_values(array_unique(array_merge($removedCards, $parser->parse($removed))));
	}
	$deck->removeCards($removedCards);

	for ($i = 0; $i < $S; $i++)
	{
	    $sought = stream_get_line(STDIN, 15 + 1, "\n");
	    $soughtCards = array_values(array_unique(array_merge($soughtCards, $parser->parse($sought))));
	}

	$removeFromSought = [];
	for ($i = 0; $i < count($soughtCards); $i++) {
	    
	    if (!$deck->has($soughtCards[$i])) {
	        $removeFromSought[] = $soughtCards[$i];
	    }
	}
	$soughtCards = array_diff($soughtCards, $removeFromSought);
	$probability = (int) (count($soughtCards)/(52-count($removedCards))*100);

	echo "$probability%\n";

	class Cards {
		public const VALUES = ['2', '3', '4', '5', '6', '7', '8', '9', 'T', 'J', 'Q', 'K', 'A'];
	    public const SUITS = ['H', 'S', 'C', 'D'];
	}

	class Deck {
        /** @var string[]  */
		private $cards = [];
		
		public function __construct() {
			$cards = [];
	        for ($i = 0; $i < count(Cards::SUITS); $i++) {
	            for ($j = 0; $j < count(Cards::VALUES); $j++) {
	                $cards[] = Cards::VALUES[$j].Cards::SUITS[$i];
	            }
	        }
	        $this->cards = array_flip($cards);
		}

	    public function has(string $card) {
	        return isset($this->cards[$card]);
	    }

	    public function removeCards(array $cardList) {
	        for ($i = 0; $i < count($cardList); $i++) {
	            unset($this->cards[$cardList[$i]]);
	        }
	    }
	}

	class CardsParser {
	    public function parse(string $cardList) {
	    	$list = str_split($cardList);

	        if (!$this->hasValues($list)) {
	            return $this->parseSuitsOnly($list);
	        }
	        if (!$this->hasSuits($list)) {
	            return $this->parseValuesOnly($list);
	        } 
	        
	        return $this->parseMixed($list);
	    }

	    private function hasValues(array $list): bool {
	        return !empty(array_intersect($list, Cards::VALUES));
	    }

	    private function hasSuits(array $list): bool {
	        return !empty(array_intersect($list, Cards::SUITS));
	    }

	    private function parseSuitsOnly(array $list) {
	        $cards = [];
	        for ($i = 0; $i < count($list); $i++) {
	            for ($j = 0; $j < count(Cards::VALUES); $j++) {
	                $cards[] = Cards::VALUES[$j].$list[$i];
	            }
	        }
	        return $cards;
	    }

	    private function parseValuesOnly(array $list) {
	        $cards = [];
	        for ($i = 0; $i < count(Cards::SUITS); $i++) {
	            for ($j = 0; $j < count($list); $j++) {
	                $cards[] = $list[$j].Cards::SUITS[$i];
	            }
	        }
	        return $cards;
	    }

	    private function parseMixed(array $list) {
	        $parsedCards = [];
	        $parsedValues = [];
	        $parsedSuits = [];
	        
	        for ($x = 0; $x < count($list); $x++) {
	            if (in_array($list[$x], Cards::VALUES)) {
	                $parsedValues[] = $list[$x];
	            } else {
	                $parsedSuits[] = $list[$x];
	            }
	        }

	        for ($x = 0; $x < count($parsedSuits); $x++) {
	            for ($y = 0; $y < count($parsedValues); $y++) {
	                $parsedCards[] = $parsedValues[$y].$parsedSuits[$x];
	            }
	        }

	        return $parsedCards;
	    }
	}
?>