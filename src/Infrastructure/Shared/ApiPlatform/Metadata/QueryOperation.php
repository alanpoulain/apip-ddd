<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\ApiPlatform\Metadata;

use ApiPlatform\Metadata\Operation;
use App\Application\Shared\Query\QueryInterface;

final class QueryOperation extends Operation
{
    /**
     * @var class-string<QueryInterface>
     */
    private string $query;

    /**
     * @param class-string<QueryInterface> $query
     */
    public function __construct(
        string $uriTemplate,
        string $query,
        ?string $shortName = null,
        ?string $description = null,
        ?array $types = null,
        $formats = null,
        $inputFormats = null,
        $outputFormats = null,
        $uriVariables = null,
        ?string $routePrefix = null,
        ?string $routeName = null,
        ?array $defaults = null,
        ?array $requirements = null,
        ?array $options = null,
        ?bool $stateless = null,
        ?string $sunset = null,
        ?string $acceptPatch = null,
        $status = null,
        ?string $host = null,
        ?array $schemes = null,
        ?string $condition = null,
        ?string $controller = null,
        ?string $class = null,
        ?int $urlGenerationStrategy = null,
        ?bool $collection = null,
        ?string $deprecationReason = null,
        ?array $cacheHeaders = null,
        ?array $normalizationContext = null,
        ?array $denormalizationContext = null,
        ?array $hydraContext = null,
        ?array $openapiContext = null,
        ?array $swaggerContext = null,
        ?array $validationContext = null,
        ?array $filters = null,
        ?bool $elasticsearch = null,
        $mercure = null,
        $messenger = null,
        $input = null,
        $output = null,
        ?array $order = null,
        ?bool $fetchPartial = null,
        ?bool $forceEager = null,
        ?bool $paginationClientEnabled = null,
        ?bool $paginationClientItemsPerPage = null,
        ?bool $paginationClientPartial = null,
        ?array $paginationViaCursor = null,
        ?bool $paginationEnabled = null,
        ?bool $paginationFetchJoinCollection = null,
        ?bool $paginationUseOutputWalkers = null,
        ?int $paginationItemsPerPage = null,
        ?int $paginationMaximumItemsPerPage = null,
        ?bool $paginationPartial = null,
        ?string $paginationType = null,
        ?string $security = null,
        ?string $securityMessage = null,
        ?string $securityPostDenormalize = null,
        ?string $securityPostDenormalizeMessage = null,
        ?string $securityPostValidation = null,
        ?string $securityPostValidationMessage = null,
        ?bool $compositeIdentifier = null,
        ?array $exceptionToStatus = null,
        ?bool $queryParameterValidationEnabled = null,
        ?bool $read = null,
        ?bool $deserialize = null,
        ?bool $validate = null,
        ?bool $write = null,
        ?bool $serialize = null,
        ?bool $queryParameterValidate = null,
        ?int $priority = null,
        ?string $name = null,
        array $extraProperties = []
    ) {
        $this->query = $query;

        $args = func_get_args();

        // remove the extra query parameter
        unset($args[1]);

        parent::__construct(self::METHOD_GET, ...array_values($args));
    }

    /**
     * @return class-string<QueryInterface>
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @param class-string<QueryInterface> $query
     */
    public function withQuery(string $query): static
    {
        $self = clone $this;
        $self->query = $query;

        return $self;
    }
}
