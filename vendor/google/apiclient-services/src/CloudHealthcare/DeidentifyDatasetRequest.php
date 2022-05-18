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

namespace Google\Service\CloudHealthcare;

class DeidentifyDatasetRequest extends \Google\Model
{
  protected $configType = DeidentifyConfig::class;
  protected $configDataType = '';
  public $destinationDataset;

  /**
   * @param DeidentifyConfig
   */
  public function setConfig(DeidentifyConfig $config)
  {
    $this->config = $config;
  }
  /**
   * @return DeidentifyConfig
   */
  public function getConfig()
  {
    return $this->config;
  }
  public function setDestinationDataset($destinationDataset)
  {
    $this->destinationDataset = $destinationDataset;
  }
  public function getDestinationDataset()
  {
    return $this->destinationDataset;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(DeidentifyDatasetRequest::class, 'Google_Service_CloudHealthcare_DeidentifyDatasetRequest');
