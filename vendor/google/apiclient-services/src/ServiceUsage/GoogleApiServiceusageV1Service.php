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

namespace Google\Service\ServiceUsage;

class GoogleApiServiceusageV1Service extends \Google\Model
{
  protected $configType = GoogleApiServiceusageV1ServiceConfig::class;
  protected $configDataType = '';
  public $name;
  public $parent;
  public $state;

  /**
   * @param GoogleApiServiceusageV1ServiceConfig
   */
  public function setConfig(GoogleApiServiceusageV1ServiceConfig $config)
  {
    $this->config = $config;
  }
  /**
   * @return GoogleApiServiceusageV1ServiceConfig
   */
  public function getConfig()
  {
    return $this->config;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setParent($parent)
  {
    $this->parent = $parent;
  }
  public function getParent()
  {
    return $this->parent;
  }
  public function setState($state)
  {
    $this->state = $state;
  }
  public function getState()
  {
    return $this->state;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleApiServiceusageV1Service::class, 'Google_Service_ServiceUsage_GoogleApiServiceusageV1Service');
