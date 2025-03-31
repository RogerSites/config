<?php

namespace RogerSites\Configurations\Enums;

enum TransactionTypes: int
{
   case CREDIT = 1;

   case DEBIT = 2;
}