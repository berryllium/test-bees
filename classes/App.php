<?php

final class App
{
    /**
     * @var Bee[] $bees
     */
    private array $bees = [];
    private string $storage;
    public function __construct()
    {
        $this->storage = '../storage/' . session_id() . '.txt';
        $this->loadState();
    }

    private function initNewGame(): array
    {
        $beeFactory = new BeeFactory();
        $this->bees = $beeFactory->make([
            'queen' => 1,
            'worker' => 5,
            'scout' => 8
        ]);
        $this->saveState();
        return $this->bees;
    }

    public function loadState()
    {
        if(!file_exists($this->storage)) {
            $this->initNewGame();
        } else {
            $data = file_get_contents($this->storage);
            $this->bees = unserialize($data);
            if(!$this->getAliveBees()) {
                $this->initNewGame();
            }
        }
        return $this->bees;
    }

    public function saveState()
    {
        file_put_contents($this->storage, serialize($this->bees));
    }

    public function hitRandomBee(): array
    {
        foreach ($this->bees as $bee) {
            $bee->unsetSelect();
        }

        $aliveBees = $this->getAliveBees();

        if(empty($aliveBees)) {
            return ['win' => true];
        }

        $randomBeeId = array_rand($aliveBees);
        $this->bees[$randomBeeId]->hit();
        $this->bees[$randomBeeId]->setSelect();

        if($this->bees[$randomBeeId]->getType() == 'queen' && !$this->bees[$randomBeeId]->isAlive()) {
            foreach ($this->bees as $bee) {
                $bee->kill();
            }
        }

        $this->saveState();

        $aliveBees = $this->getAliveBees();
        if(empty($aliveBees)) {
            return ['win' => true];
        }

        return [
            'id' => $randomBeeId,
            'data' => $this->bees[$randomBeeId],
            'aliveBees' => $aliveBees,
        ];
    }

    private function getAliveBees(): array
    {
        return array_filter($this->bees, function(Bee $bee){
            return $bee->isAlive();
        });
    }
}