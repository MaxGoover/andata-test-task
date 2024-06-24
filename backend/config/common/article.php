<?php

declare(strict_types=1);

use App\Adapters\Http\Actions\Article\ArticleCreateAction;
use App\Adapters\Http\Actions\Article\ArticleDeleteAction;
use App\Adapters\Http\Actions\Article\ArticleGetCommentsAction;
use App\Adapters\Http\Actions\Article\ArticleIndexAction;
use App\Adapters\Http\Actions\Article\ArticleShowAction;
use App\Adapters\Http\Actions\Article\ArticleUpdateAction;
use App\Entities\Article\ArticleRepositoryInterface;
use App\Infrastructure\Mysql\Repositories\ArticleRepository;
use App\UseCases\Article\ArticleCreateCommand;
use App\UseCases\Article\ArticleDeleteCommand;
use App\UseCases\Article\ArticleIndexCommand;
use App\UseCases\Article\ArticleShowCommand;
use App\UseCases\Article\ArticleUpdateCommand;
use App\UseCases\Comment\CommentGetByArticleIdCommand;
use App\UseCases\Comment\CommentGetCountByArticleIdCommand;
use Psr\Container\ContainerInterface;

return [
    ArticleRepositoryInterface::class => function (ContainerInterface $container) {
        return new ArticleRepository($container->get('pdo'));
    },

    // create
    ArticleCreateCommand::class => function (ContainerInterface $container) {
        return new ArticleCreateCommand($container->get(ArticleRepositoryInterface::class));
    },
    ArticleCreateAction::class => function (ContainerInterface $container) {
        return new ArticleCreateAction($container->get(ArticleCreateCommand::class));
    },

    // delete
    ArticleDeleteCommand::class => function (ContainerInterface $container) {
        return new ArticleDeleteCommand($container->get(ArticleRepositoryInterface::class));
    },
    ArticleDeleteAction::class => function (ContainerInterface $container) {
        return new ArticleDeleteAction($container->get(ArticleDeleteCommand::class));
    },

    // get comments
    ArticleGetCommentsAction::class => function (ContainerInterface $container) {
        return new ArticleGetCommentsAction(
            $container->get(CommentGetByArticleIdCommand::class),
            $container->get(CommentGetCountByArticleIdCommand::class),
        );
    },

    // index
    ArticleIndexCommand::class => function (ContainerInterface $container) {
        return new ArticleIndexCommand($container->get(ArticleRepositoryInterface::class));
    },
    ArticleIndexAction::class => function (ContainerInterface $container) {
        return new ArticleIndexAction($container->get(ArticleIndexCommand::class));
    },

    // show
    ArticleShowCommand::class => function (ContainerInterface $container) {
        return new ArticleShowCommand($container->get(ArticleRepositoryInterface::class));
    },
    ArticleShowAction::class => function (ContainerInterface $container) {
        return new ArticleShowAction(
            $container->get(ArticleShowCommand::class),
            $container->get(CommentGetByArticleIdCommand::class),
            $container->get(CommentGetCountByArticleIdCommand::class),
        );
    },

    // update
    ArticleUpdateCommand::class => function (ContainerInterface $container) {
        return new ArticleUpdateCommand($container->get(ArticleRepositoryInterface::class));
    },
    ArticleUpdateAction::class => function (ContainerInterface $container) {
        return new ArticleUpdateAction($container->get(ArticleUpdateCommand::class));
    },
];
