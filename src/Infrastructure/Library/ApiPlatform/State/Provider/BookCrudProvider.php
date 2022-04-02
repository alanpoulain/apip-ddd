<?php

declare(strict_types=1);

namespace App\Infrastructure\Library\ApiPlatform\State\Provider;

use ApiPlatform\State\Pagination\Pagination;
use ApiPlatform\State\ProviderInterface;
use App\Application\Library\Query\FindBookQuery;
use App\Application\Library\Query\FindBooksQuery;
use App\Domain\Library\Repository\BookRepositoryInterface;
use App\Domain\Shared\Query\QueryBusInterface;
use App\Infrastructure\Library\ApiPlatform\Resource\BookResource;
use App\Infrastructure\Shared\ApiPlatform\State\Paginator;

final class BookCrudProvider implements ProviderInterface
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private Pagination $pagination,
    ) {
    }

    /**
     * @return BookResource|Paginator<BookResource>|array<BookResource>
     */
    public function provide(string $resourceClass, array $identifiers = [], ?string $operationName = null, array $context = []): object|array|null
    {
        if ('item' === $context['operation_type']) {
            /** @var Book|null $model */
            $model = $this->queryBus->ask(new FindBookQuery($identifiers['id']));

            return null !== $model ? BookResource::fromModel($model) : null;
        }

        $author = $context['filters']['author'] ?? null;
        $offset = $limit = null;

        if ($this->pagination->isEnabled($resourceClass, $operationName, $context)) {
            $offset = $this->pagination->getPage($context);
            $limit = $this->pagination->getLimit($resourceClass, $operationName, $context);
        }

        /** @var BookRepositoryInterface $models */
        $models = $this->queryBus->ask(new FindBooksQuery($author, $offset, $limit));

        $resources = [];
        foreach ($models as $model) {
            $resources[] = BookResource::fromModel($model);
        }

        if (null !== $paginator = $models->paginator()) {
            $resources = new Paginator(
                $resources,
                (float) $paginator->getCurrentPage(),
                (float) $paginator->getItemsPerPage(),
                (float) $paginator->getLastPage(),
                (float) $paginator->getTotalItems(),
            );
        }

        return $resources;
    }

    public function supports(string $resourceClass, array $identifiers = [], ?string $operationName = null, array $context = []): bool
    {
        return BookResource::class === $resourceClass;
    }
}
