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

namespace Google\Service\Compute;

class HealthCheckService extends \Google\Collection
{
  protected $collection_key = 'notificationEndpoints';
  public $creationTimestamp;
  public $description;
  public $fingerprint;
  public $healthChecks;
  public $healthStatusAggregationPolicy;
  public $id;
  public $kind;
  public $name;
  public $networkEndpointGroups;
  public $notificationEndpoints;
  public $region;
  public $selfLink;

  public function setCreationTimestamp($creationTimestamp)
  {
    $this->creationTimestamp = $creationTimestamp;
  }
  public function getCreationTimestamp()
  {
    return $this->creationTimestamp;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function setFingerprint($fingerprint)
  {
    $this->fingerprint = $fingerprint;
  }
  public function getFingerprint()
  {
    return $this->fingerprint;
  }
  public function setHealthChecks($healthChecks)
  {
    $this->healthChecks = $healthChecks;
  }
  public function getHealthChecks()
  {
    return $this->healthChecks;
  }
  public function setHealthStatusAggregationPolicy($healthStatusAggregationPolicy)
  {
    $this->healthStatusAggregationPolicy = $healthStatusAggregationPolicy;
  }
  public function getHealthStatusAggregationPolicy()
  {
    return $this->healthStatusAggregationPolicy;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getId()
  {
    return $this->id;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setNetworkEndpointGroups($networkEndpointGroups)
  {
    $this->networkEndpointGroups = $networkEndpointGroups;
  }
  public function getNetworkEndpointGroups()
  {
    return $this->networkEndpointGroups;
  }
  public function setNotificationEndpoints($notificationEndpoints)
  {
    $this->notificationEndpoints = $notificationEndpoints;
  }
  public function getNotificationEndpoints()
  {
    return $this->notificationEndpoints;
  }
  public function setRegion($region)
  {
    $this->region = $region;
  }
  public function getRegion()
  {
    return $this->region;
  }
  public function setSelfLink($selfLink)
  {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink()
  {
    return $this->selfLink;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(HealthCheckService::class, 'Google_Service_Compute_HealthCheckService');
