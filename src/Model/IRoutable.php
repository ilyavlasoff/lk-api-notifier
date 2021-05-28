<?php

namespace App\Model;

interface IRoutable
{
    public function getRoutingKey(): string;

    public function getExchangeName(): string;
}