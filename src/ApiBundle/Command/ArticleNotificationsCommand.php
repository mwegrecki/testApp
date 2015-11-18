<?php

namespace ApiBundle\Command;

use ApiBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ArticleNotificationsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:article:notifications')
            ->setDescription('Send an email to the writer of an article if he has notifications from more than 24 hours')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $articles = $container->get('doctrine')
            ->getRepository('ApiBundle:Article')
            ->findArticlesWithNewNotifications();

        foreach($articles as $article) {
            /* @var Article $article */
            $output->writeln(sprintf('Sending mail to %s', $article->getEmail()));

            $message = \Swift_Message::newInstance()
                ->setSubject('Notification update')
                ->setFrom('notifications@testApp.com')
                ->setTo($article->getEmail())
                ->setBody(
                    $container->get('templating')->render(
                        ':Emails:notification.html.twig',
                        array('email' => $article->getEmail())
                    ),
                    'text/html'
                );

            $container
                ->get('mailer')
                ->send($message);
        }

        $output->writeln('All notifications send');
    }
}