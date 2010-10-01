<?php

/**
 * Application Console
 * 
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-08-18
 * @package exj.bettlez
 */
class AppConsoleController extends ConsoleController
{
	protected $taskLocation = false;
	
	protected function init()
	{
		// get real path for tasks locations
		$this->taskLocation = realpath(dirname(__FILE__).'/tasks/').DS;
		if (!is_dir($this->taskLocation)) {
			$this->console->error(sprintf('Tasks directory not found (%s).', $this->taskLocation));
		}
		return parent::init();
	}
	
	protected function main()
	{
		global $argv;
		// get desired job name from console argument list
		$jobname = coalesce(@$argv[1], false);
		$jobname = preg_replace('@[^A-Z0-9a-z_-]@i', '', $jobname);
		if (empty($jobname)) {
			$this->console->out('AppConsole');
			$this->console->out('----------');
			$availableJobs = $this->availableJobs();
			if (empty($availableJobs)) {
				$this->console->quit('No tasks found.');
			}
			foreach($availableJobs as $index => $jobname) {
				$this->console->out(sprintf('[%s] %s', str_pad($index + 1, strlen(count($availableJobs)), ' ', STR_PAD_LEFT), $jobname));
			}
			$result = trim($this->console->read('Please choose job:')) - 1;
			if (empty($availableJobs[$result])) {
				$this->console->quit('invalid job selected');
			}
			$jobname = $availableJobs[$result];
		}
		try {
			$task = $this->loadTask($jobname, array_slice($argv, 1));
		} catch (AppConsoleControllerTaskNotFoundException $e) {
			$this->console->quit(sprintf('Unable to open task "%s"', $jobname));
		}
		return true;
	}
	
	/**
	 * Loads a specific task by it’s $name and calls it with
	 * the $arguments like it’s called on command line
	 * @param string $name
	 * @param array() $arguments
	 * @return ConsoleController
	 */
	protected function loadTask($name, Array $arguments = Array())
	{
		$filename = $this->taskLocation.$name.'.php';
		if (!is_file($filename)) {
			throw new AppConsoleTaskNotFoundException($this, $name);
		}
		// load job and run it
		require $filename;
		global $argv;
		$argv = $arguments;
		$jobClassname = Inflector::camelize($name, true).'Controller';
		return new $jobClassname(new HTTPRequest());
	}
	
	/**
	 * Return a list of available Jobs in the tasks directory if it exists
	 * @return array(string)
	 */
	protected function availableJobs()
	{
		$ignoreList = array(
			'/Arguments/i',
		);
		$jobs = array();
		foreach(glob($this->taskLocation.'*.php') as $filename) {
			$jobname = substr(basename($filename), 0, -4);
			foreach($ignoreList as $regexp) {
				if (preg_match($regexp, $jobname)) continue 2;
			}
			$jobs[] = $jobname;
		}
		return $jobs;
	}
}

class AppConsoleControllerException extends ControllerException {} 
class AppConsoleControllerTaskNotFoundException extends AppConsoleControllerException {}