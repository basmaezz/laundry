<?php

namespace App\Enums;

final class orderStatusEnum
{
    const WaitingForDelivery            = 1;
    const AcceptedByDelivery            = 2;
    const WayToLaundry                  = 3;
    const DeliveredToLaundry            = 4;
    const ClothesReadyForDelivery       = 5;
    const WaitingForDeliveryToReceiveOrder = 6;
    const AcceptedByDeliveryToYou       = 7;
    const Completed                     = 8;
    const Cancel                        = 10;
}
