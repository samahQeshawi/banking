<?php

namespace App\Utilities;

use Closure;
use Illuminate\Http\Resources\Json\JsonResource;

class JsonResourceHelper extends JsonResource
{
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    public function getResourceCollection($callback): array
    {
        $data = [];
        foreach ($this->resource as $resource) {
            $data[] = $this->getResource($resource, $callback);
        }

        return $data;
    }

    public function getResourceItem($callback)
    {
        return $this->getResource($this->resource, $callback);
    }

    public function getResource($resource, $closure)
    {
        if (! isset($resource)) {
            return null;
        }

        return new (new class($resource, $closure) extends JsonResourceHelper
        {
            protected Closure $closure;

            public function __construct($resource, $closure)
            {
                parent::__construct($resource);
                $this->closure = $closure;
            }

            public function toArray($request)
            {
                return ($this->closure)($this);
            }
        })($resource, $closure);
    }
}
