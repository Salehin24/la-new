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

namespace Google\Service\SecretManager;

class ListSecretsResponse extends \Google\Collection
{
  protected $collection_key = 'secrets';
  public $nextPageToken;
  protected $secretsType = Secret::class;
  protected $secretsDataType = 'array';
  public $totalSize;

  public function setNextPageToken($nextPageToken)
  {
    $this->nextPageToken = $nextPageToken;
  }
  public function getNextPageToken()
  {
    return $this->nextPageToken;
  }
  /**
   * @param Secret[]
   */
  public function setSecrets($secrets)
  {
    $this->secrets = $secrets;
  }
  /**
   * @return Secret[]
   */
  public function getSecrets()
  {
    return $this->secrets;
  }
  public function setTotalSize($totalSize)
  {
    $this->totalSize = $totalSize;
  }
  public function getTotalSize()
  {
    return $this->totalSize;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ListSecretsResponse::class, 'Google_Service_SecretManager_ListSecretsResponse');
