<?php
namespace Vda\Transaction;

interface ITransactionCapable
{
    /**
     * Begin transaction
     *
     * @throws TransactionException If transaction is failed to start
     */
    public function begin();

    /**
     * Commit transaction
     *
     * @throws TransactionException If transaction failed to commit
     */
    public function commit();

    /**
     * Rollback changes made by this transaction
     *
     * @throws TransactionException If transaction failed to rollback
     */
    public function rollback();

    /**
     * Check if there are a transaction in progress
     *
     * @return boolean
     */
    public function isTransactionStarted();

    public function addTransactionListener(ITransactionListener $listener);

    public function removeTransactionListener(ITransactionListener $listener);
}
