<?php

declare(strict_types=1);

use App\Adapters\Http\Actions\Article\ArticleCreateAction;
use App\Adapters\Http\Actions\Article\ArticleGetCommentsAction;
use App\Adapters\Http\Actions\Article\ArticleIndexAction;
use App\Adapters\Http\Actions\Article\ArticleShowAction;
use App\Infrastructure\Mysql\Repositories\ArticleRepository;
use App\UseCases\Article\ArticleCreateCommand;
use App\UseCases\Article\ArticleIndexCommand;
use App\UseCases\Article\ArticleShowCommand;
use App\UseCases\Comment\CommentGetByArticleIdCommand;
use App\UseCases\Comment\CommentGetCountByArticleIdCommand;
use Psr\Container\ContainerInterface;

return [
    ArticleRepository::class => function (ContainerInterface $container) {
        return new ArticleRepository($container->get('pdo'));
    },

    // create
    ArticleCreateCommand::class => function (ContainerInterface $container) {
        return new ArticleCreateCommand($container->get(ArticleRepository::class));
    },
    ArticleCreateAction::class => function (ContainerInterface $container) {
        return new ArticleCreateAction($container->get(ArticleCreateCommand::class));
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
        return new ArticleIndexCommand($container->get(ArticleRepository::class));
    },
    ArticleIndexAction::class => function (ContainerInterface $container) {
        return new ArticleIndexAction($container->get(ArticleIndexCommand::class));
    },

    // show
    ArticleShowCommand::class => function (ContainerInterface $container) {
        return new ArticleShowCommand($container->get(ArticleRepository::class));
    },
    ArticleShowAction::class => function (ContainerInterface $container) {
        return new ArticleShowAction(
            $container->get(ArticleShowCommand::class),
            $container->get(CommentGetByArticleIdCommand::class),
            $container->get(CommentGetCountByArticleIdCommand::class),
        );
    },
];
