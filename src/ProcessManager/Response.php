<?php

namespace ProcessManager;

class Response
{
	private $data;
	private $status;
	private $headers;

	public function __construct($data = null, $status = 200,array $headers = [])
	{
		$this->data = $data;
		$this->status = $status;
		$this->headers = $headers;
		return $this;
	}

	public function create($data, $status = null, array $headers = null)
	{
		$this->data = $data ?? $this->data;
		$this->status = $status ?? $this->status;
		$this->headers = $headers ?? $this->headers;
		return $this;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getHeaders()
	{
		return $this->headers;
	}

	public function getHeader($key)
	{
		return $this->headers[$key];
	}

	public function dataArray()
	{
		return ['data' => $this->data, 'status' => $this->status, 'headers' => $this->headers];
	}
}