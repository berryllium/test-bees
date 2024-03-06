<?php

class BeeFactory
{
    /**
     * @param array $params
     * @return Bee[]
     */
    public function make(array $params) : array
    {
        $bees = [];
        foreach ($params as $type => $quantity) {
            if($type == 'queen') {
                $class = Queen::class;
            } elseif($type == 'worker') {
                $class = Worker::class;
            } elseif($type == 'scout') {
                $class = Scout::class;
            } else {
                throw new \Exception('Unknown bee type');
            }

            for($i = 0; $i < $quantity; $i++) {
                $uniq_id = uniqid();
                $bees[$uniq_id] = new $class($uniq_id);
            }
        }

        return $bees;
    }
}