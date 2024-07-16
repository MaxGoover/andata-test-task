<?php

declare(strict_types=1);

use App\Adapters\Http\Actions\Comment\CommentCreateAction;
use App\Adapters\Http\Actions\Comment\CommentDeleteAction;
use App\Adapters\Http\Actions\Comment\CommentUpdateAction;
use App\Entities\Comment\CommentRepositoryInterface;
use App\Infrastructure\Mysql\Repositories\CommentRepository;
use App\UseCases\Comment\CommentCreateCommand;
use App\UseCases\Comment\CommentDeleteCommand;
use App\UseCases\Comment\CommentGetByArticleIdCommand;
use App\UseCases\Comment\CommentGetCountByArticleIdCommand;
use App\UseCases\Comment\CommentUpdateCommand;
use Psr\Container\ContainerInterface;

return [
    CommentRepositoryInterface::class => function (ContainerInterface $container) {
        return new CommentRepository($container->get(PDO::class));
    },

    // create
    CommentCreateAction::class => function (ContainerInterface $container) {
        return new CommentCreateAction($container->get(CommentCreateCommand::class));
    },

    // delete
    CommentDeleteAction::class => function (ContainerInterface $container) {
        return new CommentDeleteAction($container->get(CommentDeleteCommand::class));
    },

    // update
    CommentUpdateAction::class => function (ContainerInterface $container) {
        return new CommentUpdateAction($container->get(CommentUpdateCommand::class));
    },

    // other
    CommentGetByArticleIdCommand::class => function (ContainerInterface $container) {
        return new CommentGetByArticleIdCommand($container->get(CommentRepositoryInterface::class));
    },
    CommentGetCountByArticleIdCommand::class => function (ContainerInterface $container) {
        return new CommentGetCountByArticleIdCommand($container->get(CommentRepositoryInterface::class));
    },
];
