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

namespace Google\Service\Dialogflow;

class GoogleCloudDialogflowV2beta1IntentMessageColumnProperties extends \Google\Model
{
  public $header;
  public $horizontalAlignment;

  public function setHeader($header)
  {
    $this->header = $header;
  }
  public function getHeader()
  {
    return $this->header;
  }
  public function setHorizontalAlignment($horizontalAlignment)
  {
    $this->horizontalAlignment = $horizontalAlignment;
  }
  public function getHorizontalAlignment()
  {
    return $this->horizontalAlignment;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDialogflowV2beta1IntentMessageColumnProperties::class, 'Google_Service_Dialogflow_GoogleCloudDialogflowV2beta1IntentMessageColumnProperties');
