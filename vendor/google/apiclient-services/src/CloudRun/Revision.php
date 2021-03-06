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

namespace Google\Service\CloudRun;

class Revision extends \Google\Model
{
  public $apiVersion;
  public $kind;
  protected $metadataType = ObjectMeta::class;
  protected $metadataDataType = '';
  protected $specType = RevisionSpec::class;
  protected $specDataType = '';
  protected $statusType = RevisionStatus::class;
  protected $statusDataType = '';

  public function setApiVersion($apiVersion)
  {
    $this->apiVersion = $apiVersion;
  }
  public function getApiVersion()
  {
    return $this->apiVersion;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  /**
   * @param ObjectMeta
   */
  public function setMetadata(ObjectMeta $metadata)
  {
    $this->metadata = $metadata;
  }
  /**
   * @return ObjectMeta
   */
  public function getMetadata()
  {
    return $this->metadata;
  }
  /**
   * @param RevisionSpec
   */
  public function setSpec(RevisionSpec $spec)
  {
    $this->spec = $spec;
  }
  /**
   * @return RevisionSpec
   */
  public function getSpec()
  {
    return $this->spec;
  }
  /**
   * @param RevisionStatus
   */
  public function setStatus(RevisionStatus $status)
  {
    $this->status = $status;
  }
  /**
   * @return RevisionStatus
   */
  public function getStatus()
  {
    return $this->status;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Revision::class, 'Google_Service_CloudRun_Revision');
