<?php

namespace Virgule\Bundle\MainBundle\Manager;

use Virgule\Bundle\MainBundle\Manager\BaseManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelpManager extends BaseManager {

    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    /**
     * Open a ticket on GitHub
     * 
     * 
        // POST /repos/:owner/:repo/issues
        title
        body
        labels
        
        {
  "title": "Found a bug",
  "body": "I'm having a problem with this.",
  "assignee": "octocat",
  "milestone": 1,
  "labels": [
    "Label1",
    "Label2"
  ]
}

return issue ID
     */
    public function reportIssue() {
        $githubApiUrl = $this->container->getParameter('github_api_url');
        $githubUser = $this->container->getParameter('github_user');
        $githubPassword = $this->container->getParameter('github_password');
        $githubRepository = $this->container->getParameter('github_repository');
        $githubRepositoryOwner = $this->container->getParameter('github_repository_owner');
        
        $url = $githubApiUrl . '/repos/'. $githubRepositoryOwner . '/'. $githubRepository . '/issues';
        $content .= '?title=new issue&body=I\'m having a problem with this';
        $headers = array('Content-type: application/json');
        $buzz = $this->container->get('buzz');
        $buzz->post($url, $headers, $content);

        $client = new Buzz\Client\FileGetContents();
        $client->send($request, $response);

        // If using JSON...
        $data = json_decode($response);
    }
}

?>