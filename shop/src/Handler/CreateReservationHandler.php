<?php

declare(strict_types=1);

namespace App\Handler;

use Footshop\ReservationCreateRequest;
use Footshop\ReservationCreateResponse\Result;
use Footshop\StockClient;
use Twirp\Error;

final class CreateReservationHandler
{
    public function handle(string $ean , int $quantity): string
    {
        $stock = new StockClient('http://localhost:8002');

        $request = new ReservationCreateRequest();
        $request->setEan($ean);
        $request->setQuantity($quantity);

        $response = $stock->ReservationCreate([], $request);

        return Result::name($response->getResult());
    }
}
