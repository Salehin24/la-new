<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Spanner;

class RequestOptions extends \Google\Model
{
  public $priority;
  public $requestTag;
  public $transactionTag;

  public function setPriority($priority)
  {
    $this->priority = $priority;
  }
  public function getPriority()
  {
    return $this->priority;
  }
  public function setRequestTag($requestTag)
  {
    $this->requestTag = $requestTag;
  }
  public function getRequestTag()
  {
    return $this->requestTag;
  }
  public function setTransactionTag($transactionTag)
  {
    $this->transactionTag = $transactionTag;
  }
  public function getTransactionTag()
  {
    return $this->transactionTag;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(RequestOptions::class, 'Google_Service_Spanner_RequestOptions');
