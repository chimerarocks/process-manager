<?php

namespace ProcessManager\Processes\Observers;

use ProcessManager\Processes\AbstractObserverProcess;

class ObserverLastUpdatedAndSendSMSProcess extends AbstractObserverProcess
{
	public $timediff;

	private $sendSMSService;
	private $repository;
	private $clients;
	private $message;

	public function __construct($repository, $sendSMSService, array $clients, string $message)
	{
		$this->sendSMSService = $sendSMSService;
		$this->repository = $repository;
		$this->clients = $clients;
		$this->message = $message;
	}

	protected function getObservableEntity()
	{
		return $this->repository->getLastUpdatedEntity();
	}

	protected function getObservableProperty($entity)
	{
		$date = $entity->getUpdatedAt();
		if (!empty($date)) {
			return strtotime($entity->getUpdatedAt()->format('Y-m-d H:i:s'));
		}
		return false;
	}

	protected function shouldDispatch($property)
	{
		if ($property) {
			$now = new \DateTime('now');
			$nTime = strtotime($now->format('Y-m-d H:i:s'));
			if ($nTime - $property > $this->timediff) {
				return true;
			};
		}
		return false;
	}

	protected function dispatch()
	{
		foreach ($this->clients as $client) {
			$this->sendSMSService->send($client, $this->message);
		}
	}

	protected function haveToDie()
	{
		return true;
	}
}