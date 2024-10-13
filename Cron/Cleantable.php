<?php

namespace Lotsofpixels\CleanStockReservation\Cron;

use Magento\Framework\App\ResourceConnection;
use Psr\Log\LoggerInterface;

/**
 *
 */
class Cleantable
{

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        ResourceConnection                              $resourceConnection,
        LoggerInterface                                 $logger
    )
    {
        $this->resourceConnection = $resourceConnection;
        $this->logger = $logger;
    }

    /**
     * @return void
     */
    public function execute():void
    {

        $connection = $this->resourceConnection->getConnection();
        $table = $connection->getTableName('inventory_reservation');
        $query = "truncate table " . $table . ";";
        $connection->truncateTable($table);
        $this->logger->info('Stock reservations removed' );
    }
}