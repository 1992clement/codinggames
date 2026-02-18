<?php
    $rootName = stream_get_line(STDIN, 30 + 1, "\n");
    $targetName = 'Kevin Bacon';
    if ($rootName === $targetName) {
        echo 0;
        return;
    }

    $tree = buildActorsTreeFromInput();
    printSmallestLinkFromTree($tree, $rootName, $targetName);

    /**
     * @return Actor[]
     */
    function buildActorsTreeFromInput() : array {
        $actors = [];
        fscanf(STDIN, "%d", $n);
        for ($i = 0; $i < $n; $i++)
        {
            $movieCast = stream_get_line(STDIN, 200 + 1, "\n");
            $movieCastBits = explode(': ', $movieCast);
            $casting = explode(', ', $movieCastBits[1]);
            foreach ($casting as $actorName) {
                if (isset($actors[$actorName])) {
                    $actors[$actorName]->addRelationships($casting);
                } else {
                    $actors[$actorName] = new Actor($actorName);
                    $actors[$actorName]->addRelationships($casting);
                }
            }
        }

        return $actors;
    }

    /**
     * @param Actor[] $tree
     */
    function printSmallestLinkFromTree(array $tree, string $rootName, string $targetName) {
        $links = 1;
        $toVisit = $tree[$rootName]->getRelationships();
        while ($toVisit) {
            $tmp = [];
            if (isset($toVisit[$targetName])) {
                echo $links."\n";
                return;
            }
            foreach($toVisit as $name => $value) {
                $tmp = array_merge($tmp, $tree[$name]->getRelationships());
            }
            $toVisit = $tmp;
            $links++;
        }
    }

    class Actor {
        /** @var string[]  */
        private $relationships = [];
        private string $name;

        public function __construct(string $name) {
            $this->name = $name;
        }

        /**
         * @param string[] $relationships
         */
        public function addRelationships(array $relationships) {
            $this->relationships = array_merge($this->relationships, array_flip($relationships));
            unset($this->relationships[$this->name]);
        }

        /**
         * @return string[]
         */
        public function getRelationships(): array
        {
            return $this->relationships;
        }
    }
?>