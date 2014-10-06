<?php
namespace Vda\Transaction;

class DecoratingTransactionListener extends AbstractTransactionListener
{
    private $source;

    public function __construct(ISavepointCapable $source)
    {
        $this->source = $source;
    }

    protected function overrideStarted(array $started)
    {
        return empty($started) ? array() : array($this->source);
    }

    protected function overrideSource($source)
    {
        return $this->source;
    }
}
