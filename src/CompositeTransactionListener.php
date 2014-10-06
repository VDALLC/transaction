<?php
namespace Vda\Transaction;

class CompositeTransactionListener extends AbstractTransactionListener
{
    protected function overrideStarted(array $started)
    {
        return $started;
    }

    protected function overrideSource($source)
    {
        return $source;
    }
}
