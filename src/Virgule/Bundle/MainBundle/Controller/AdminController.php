<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Virgule\Bundle\MainBundle\Entity\ClassLevel;
use Virgule\Bundle\MainBundle\Form\Type\ClassLevelType;

/**
 * Admin controller.
 *
 * @Route("/admin")
 */
class AdminController extends Controller {

  /**
   * Display log file
   *
   * @Route("/show_logs", name="admin_show_logs")
   * @Template
   */
  public function showLogsAction() {
    $logDir = $this->container->parameters['kernel.logs_dir'];
    $env = $this->container->parameters['kernel.environment'];
    $logFilePath = $logDir . '/' . $env . '.log';

    $lines = array();
    $fp = fopen($logFilePath, 'r');
    while (!feof($fp)) {
      $line = fgets($fp, 4096);
      array_push($lines, $line);
      if (count($lines) > 250) {
        array_shift($lines);
      }
    }
    fclose($fp);

    $logFileContent = implode($lines);

    return array(
        'environment' => $env,
        'log_content' => $logFileContent
    );
  }

}
