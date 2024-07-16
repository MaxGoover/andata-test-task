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
        return new ArticleRepository($container->get(PDO::class));
    },

    // create
    ArticleCreateAction::class => function (ContainerInterface $container) {
        return new ArticleCreateAction($container->get(ArticleCreateCommand::class));
    },

    // delete
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
    ArticleIndexAction::class => function (ContainerInterface $container) {
        return new ArticleIndexAction($container->get(ArticleIndexCommand::class));
    },

    // show
    ArticleShowAction::class => function (ContainerInterface $container) {
        return new ArticleShowAction(
            $container->get(ArticleShowCommand::class),
            $container->get(CommentGetByArticleIdCommand::class),
            $container->get(CommentGetCountByArticleIdCommand::class),
        );
    },

    // update
    ArticleUpdateAction::class => function (ContainerInterface $container) {
        return new ArticleUpdateAction($container->get(ArticleUpdateCommand::class));
    },
];
