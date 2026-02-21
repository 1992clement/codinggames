<?php
    $player1 = new Player('Player 1');
    $player1->addCardsToDeck(getCardsInput());
    $player2 = new Player('Player 2');
    $player2->addCardsToDeck(getCardsInput());

    $turnOrder = new TurnOrder($player1, $player2);
    $stack = new Stack();
    try {
        $stack->stackCard($player1->playNextCard());
    } catch (EmptyDeckException $e) {
        $player2->printVictory();
        return;
    }

    $turnOrder->switchOrder();

    while ($player1->hasCards() && $player2->hasCards()) {
        $stack->stackCard($turnOrder->getNextPlayer()->playNextCard());
        if ($stack->isSnap()) {
            if ($stack->lastCardPlayedHasPrecedence()) {
                $turnOrder->getNextPlayer()->addCardsToDeck($stack->getFlippedStackCards());
            } else {
                $turnOrder->getPreviousPlayer()->addCardsToDeck($stack->getFlippedStackCards());
                $turnOrder->switchOrder();
            }
            $stack->resetStack();
        } else {
            $turnOrder->switchOrder();
        }
    }

    if (!$player1->hasCards()) {
        $player2->printVictory();
        return;
    }
    if (!$player2->hasCards()) {
        $player1->printVictory();
        return;
    }

    /**
     * @return Card[]
     */
    function getCardsInput(): array
    {
        $deck = [];
        fscanf(STDIN, "%d", $m);
        for ($i = 0; $i < $m; $i++) {
            fscanf(STDIN, "%s", $card);
            array_unshift($deck, new Card($card));
        }

        return $deck;
    }

    class Card {
        private const SUITS = ['S' => 4, 'H' => 3, 'D' => 2, 'C' => 1];

        /** @var string $rank */
        private $rank;

        /** @var string $suit */
        private $suit;
        public function __construct(string $cardInput)
        {
            if (strlen($cardInput) === 2) {
                $this->rank = $cardInput[0];
                $this->suit = $cardInput[1];
            }
            if (strlen($cardInput) === 3) {
                $this->rank = substr($cardInput, 0, 2);
                $this->suit = $cardInput[2];
            }
        }

        public function hasSameRank(Card $card): bool
        {
            return $this->rank === $card->getRank();
        }

        public function getRank(): string
        {
            return $this->rank;
        }

        public function hasPrecedenceOver(Card $card): bool
        {
            return self::SUITS[$this->suit] > self::SUITS[$card->getSuit()];
        }

        public function getSuit(): string
        {
            return $this->suit;
        }
    }

    class Player {
        /**
         * @var Card[] $deck
         */
        private $deck = [];

        /**
         * @var string $name
         */
        private $name;

        public function __construct(string $name)
        {
            $this->name = $name;
        }

        /**
         * @param Card[] $cards
         */
        public function addCardsToDeck(array $cards): void
        {
            $this->deck = array_merge($cards, $this->deck);
        }

        public function playNextCard(): Card
        {
            if (empty($this->deck)) {
                throw new EmptyDeckException('No card in deck');
            }

            return array_pop($this->deck);
        }

        public function hasCards(): bool
        {
            return !empty($this->deck);
        }

        public function printVictory(): void
        {
            echo 'Winner: '.$this->name."\n";
            echo count($this->deck);
        }
    }

    class EmptyDeckException extends Exception {}

    class Stack {
        /**
         * @var Card[]
         */
        private $stack = [];

        /**
         * @return Card[]
         */
        public function getFlippedStackCards(): array
        {
            return array_reverse($this->stack);
        }

        public function stackCard(Card $card): void
        {
            $this->stack[] = $card;
        }

        public function resetStack(): void
        {
            $this->stack = [];
        }

        public function isSnap(): bool
        {
            if (count($this->stack) < 2) {
                return false;
            }

            return $this->getLastCardPlayed()->hasSameRank($this->getPreviousLastCardPlayed());
        }

        public function lastCardPlayedHasPrecedence(): bool
        {
            if (count($this->stack) < 2) {
                return false;
            }

            return $this->getLastCardPlayed()->hasPrecedenceOver($this->getPreviousLastCardPlayed());
        }

        private function getLastCardPlayed(): Card
        {
            return $this->stack[array_key_last($this->stack)];
        }

        private function getPreviousLastCardPlayed(): Card
        {
            return $this->stack[array_key_last($this->stack) - 1];
        }
    }

    class TurnOrder {
        /**
         * @var Player $nextPlayer
         */
        private $nextPlayer;

        /**
         * @var Player $previousPlayer
         */
        private $previousPlayer;

        public function __construct(Player $nextPlayer, Player $previousPlayer)
        {
            $this->nextPlayer = $nextPlayer;
            $this->previousPlayer = $previousPlayer;
        }

        public function switchOrder(): void
        {
            $tmp = $this->nextPlayer;
            $this->nextPlayer = $this->previousPlayer;
            $this->previousPlayer = $tmp;
        }

        public function getNextPlayer(): Player
        {
            return $this->nextPlayer;
        }

        public function getPreviousPlayer(): Player
        {
            return $this->previousPlayer;
        }
    }

?>