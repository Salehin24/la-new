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

namespace Google\Service\ShoppingContent;

class LiasettingsCustomBatchRequestEntry extends \Google\Model
{
  public $accountId;
  public $batchId;
  public $contactEmail;
  public $contactName;
  public $country;
  public $gmbEmail;
  protected $liaSettingsType = LiaSettings::class;
  protected $liaSettingsDataType = '';
  public $merchantId;
  public $method;
  public $posDataProviderId;
  public $posExternalAccountId;

  public function setAccountId($accountId)
  {
    $this->accountId = $accountId;
  }
  public function getAccountId()
  {
    return $this->accountId;
  }
  public function setBatchId($batchId)
  {
    $this->batchId = $batchId;
  }
  public function getBatchId()
  {
    return $this->batchId;
  }
  public function setContactEmail($contactEmail)
  {
    $this->contactEmail = $contactEmail;
  }
  public function getContactEmail()
  {
    return $this->contactEmail;
  }
  public function setContactName($contactName)
  {
    $this->contactName = $contactName;
  }
  public function getContactName()
  {
    return $this->contactName;
  }
  public function setCountry($country)
  {
    $this->country = $country;
  }
  public function getCountry()
  {
    return $this->country;
  }
  public function setGmbEmail($gmbEmail)
  {
    $this->gmbEmail = $gmbEmail;
  }
  public function getGmbEmail()
  {
    return $this->gmbEmail;
  }
  /**
   * @param LiaSettings
   */
  public function setLiaSettings(LiaSettings $liaSettings)
  {
    $this->liaSettings = $liaSettings;
  }
  /**
   * @return LiaSettings
   */
  public function getLiaSettings()
  {
    return $this->liaSettings;
  }
  public function setMerchantId($merchantId)
  {
    $this->merchantId = $merchantId;
  }
  public function getMerchantId()
  {
    return $this->merchantId;
  }
  public function setMethod($method)
  {
    $this->method = $method;
  }
  public function getMethod()
  {
    return $this->method;
  }
  public function setPosDataProviderId($posDataProviderId)
  {
    $this->posDataProviderId = $posDataProviderId;
  }
  public function getPosDataProviderId()
  {
    return $this->posDataProviderId;
  }
  public function setPosExternalAccountId($posExternalAccountId)
  {
    $this->posExternalAccountId = $posExternalAccountId;
  }
  public function getPosExternalAccountId()
  {
    return $this->posExternalAccountId;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(LiasettingsCustomBatchRequestEntry::class, 'Google_Service_ShoppingContent_LiasettingsCustomBatchRequestEntry');
