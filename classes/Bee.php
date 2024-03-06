<?php

abstract class Bee implements JsonSerializable
{
    protected int $lifespan;
    protected int $impactDamage;
    protected string $type;
    protected bool $selected = false;

    protected string $id;

    public function hit()
    {
        if($this->lifespan == 0) {
            return;
        }

        if($this->impactDamage > $this->lifespan) {
            $this->lifespan = 0;
        } else {
            $this->lifespan -= $this->impactDamage;
        }
    }

    public function getLifeSpan() : int
    {
        return $this->lifespan;
    }

    public function isAlive() : bool
    {
        return $this->lifespan > 0;
    }
    
    public function isSelected()
    {
        return $this->selected;
    }
    
    public function setSelect()
    {
        $this->selected = true;
    }
    
    public function unsetSelect()
    {
        $this->selected = false;
    }
    
    public function getType()
    {
        return $this->type;
    }

    public function kill()
    {
        $this->lifespan = 0;
    }

    public function jsonSerialize(): array
    {
        return [
            'lifespan' => $this->getLifeSpan(),
            'type' => $this->getType(),
            'selected' => $this->selected,
            'alive' => $this->isAlive()
        ];
    }
}