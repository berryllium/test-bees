<?php

class Worker extends Bee
{
    protected int $lifespan = 50;
    protected int $impactDamage = 5;
    protected string $type = 'worker';
}