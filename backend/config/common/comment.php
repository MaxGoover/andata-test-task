<?php

declare(strict_types=1);

use App\Adapters\Http\Actions\Comment\CommentCreateAction;
use App\Entities\Comment\CommentRepositoryInterface;
use App\Infrastructure\Mysql\Repositories\CommentRepository;
use App\UseCases\Comment\CommentCreateCommand;
use App\UseCases\Comment\CommentGetByArticleIdCommand;
use App\UseCases\Comment\CommentGetCountByArticleIdCommand;
use Psr\Container\ContainerInterface;

return [
    CommentRepositoryInterface::class => function (ContainerInterface $container) {
        return new CommentRepository($container->get('pdo'));
    },

    // create
    CommentCreateCommand::class => function (ContainerInterface $container) {
        return new CommentCreateCommand($container->get(CommentRepositoryInterface::class));
    },
    CommentCreateAction::class => function (ContainerInterface $container) {
        return new CommentCreateAction($container->get(CommentCreateCommand::class));
    },

    // other
    CommentGetByArticleIdCommand::class => function (ContainerInterface $container) {
        return new CommentGetByArticleIdCommand($container->get(CommentRepositoryInterface::class));
    },
    CommentGetCountByArticleIdCommand::class => function (ContainerInterface $container) {
        return new CommentGetCountByArticleIdCommand($container->get(CommentRepositoryInterface::class));
    },
];
