<?php
namespace Vda\Transaction;

interface ISavepointCapable extends ITransactionCapable
{
    /**
     * Add savepoint
     *
     * @param string $savepoint
     */
    public function savepoint($savepoint);

    /**
     * Remove savepoint without rolling back or committing the changes
     *
     * @param string $savepoint
     */
    public function release($savepoint);

    /**
     * Undo all changes made after the given savepoint
     *
     * @param unknown $savepoint
     */
    public function rollbackTo($savepoint);
}
