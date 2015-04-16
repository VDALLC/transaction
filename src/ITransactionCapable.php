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
     * Execute callback withing transaction.
     *
     * If callback throws an exception this method will rollback transaction and rethrow the exception.
     * If callback successfully executes (no matter what it returns) this method will commit transaction.
     *
     * @param callable $callback
     * @return mixed returns what callback returns
     */
    public function transaction(/*callable*/ $callback);

    /**
     * Check if there are a transaction in progress
     *
     * @return boolean
     */
    public function isTransactionStarted();

    public function addTransactionListener(ITransactionListener $listener);

    public function removeTransactionListener(ITransactionListener $listener);
}
