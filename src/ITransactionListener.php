<?php
namespace Vda\Transaction;

interface ITransactionListener
{
    public function onTransactionBegin(ITransactionCapable $obj);
    public function onSavepointCreate(ISavepointCapable $obj, $savepoint);
    public function onSavepointRelease(ISavepointCapable $obj, $savepoint);
    public function onSavepointRollback(ISavepointCapable $obj, $savepoint);
    public function onTransactionCommit(ITransactionCapable $obj);
    public function onTransactionRollback(ITransactionCapable $obj);
}
