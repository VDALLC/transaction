<?php
namespace Vda\Transaction;

abstract class AbstractTransactionListener implements ITransactionListener
{
    /**
     * @var ITransactionListener[]
     */
    private $listeners = array();
    private $startedObjects = array();

    public function addListener(ITransactionListener $listener)
    {
        $this->listeners[spl_object_hash($listener)] = $listener;

        foreach ($this->overrideStarted($this->startedObjects) as $obj) {
            $listener->onTransactionBegin($obj);
        }
    }

    public function removeListener(ITransactionListener $listener)
    {
        $k = spl_object_hash($listener);
        $isExist = array_key_exists($k, $this->listeners);

        if ($isExist) {
            unset($this->listeners[$k]);
        }

        return $isExist;
    }

    public function onTransactionBegin(ITransactionCapable $obj)
    {
        $this->startedObjects[spl_object_hash($obj)] = $obj;

        foreach ($this->listeners as $listener) {
            $listener->onTransactionBegin($this->overrideSource($obj));
        }
    }

    public function onSavepointCreate(ISavepointCapable $obj, $savepoint)
    {
        foreach ($this->listeners as $listener) {
            $listener->onSavepointCreate($this->overrideSource($obj), $savepoint);
        }
    }

    public function onSavepointRelease(ISavepointCapable $obj, $savepoint)
    {
        foreach ($this->listeners as $listener) {
            $listener->onSavepointRelease($this->overrideSource($obj), $savepoint);
        }
    }

    public function onSavepointRollback(ISavepointCapable $obj, $savepoint)
    {
        foreach ($this->listeners as $listener) {
            $listener->onSavepointRollback($this->overrideSource($obj), $savepoint);
        }
    }

    public function onTransactionCommit(ITransactionCapable $obj)
    {
        foreach ($this->listeners as $listener) {
            $listener->onTransactionCommit($this->overrideSource($obj));
        }

        unset($this->startedObjects[spl_object_hash($obj)]);
    }

    public function onTransactionRollback(ITransactionCapable $obj)
    {
        foreach ($this->listeners as $listener) {
            $listener->onTransactionRollback($this->overrideSource($obj));
        }

        unset($this->startedObjects[spl_object_hash($obj)]);
    }

    abstract protected function overrideStarted(array $started);

    abstract protected function overrideSource($source);
}
