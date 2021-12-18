<?php

declare(strict_types=1);

namespace Doctrine\DBAL\Driver\OCI8\Exception;

use Doctrine\DBAL\Driver\OCI8\OCI8Exception;
use function sprintf;

/**
 * @internal
 *
 * @psalm-immutable
 */
final class UnknownParameterIndex extends OCI8Exception
{
    public static function new(int $index): self
    {
        return new self(
            sprintf('Could not find variable mapping with index %d, in the SQL statement', $index)
        );
    }
}
