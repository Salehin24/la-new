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

namespace Google\Service\HangoutsChat;

class GoogleAppsCardV1DateTimePicker extends \Google\Model
{
  public $label;
  public $name;
  protected $onChangeActionType = GoogleAppsCardV1Action::class;
  protected $onChangeActionDataType = '';
  public $timezoneOffsetDate;
  public $type;
  public $valueMsEpoch;

  public function setLabel($label)
  {
    $this->label = $label;
  }
  public function getLabel()
  {
    return $this->label;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param GoogleAppsCardV1Action
   */
  public function setOnChangeAction(GoogleAppsCardV1Action $onChangeAction)
  {
    $this->onChangeAction = $onChangeAction;
  }
  /**
   * @return GoogleAppsCardV1Action
   */
  public function getOnChangeAction()
  {
    return $this->onChangeAction;
  }
  public function setTimezoneOffsetDate($timezoneOffsetDate)
  {
    $this->timezoneOffsetDate = $timezoneOffsetDate;
  }
  public function getTimezoneOffsetDate()
  {
    return $this->timezoneOffsetDate;
  }
  public function setType($type)
  {
    $this->type = $type;
  }
  public function getType()
  {
    return $this->type;
  }
  public function setValueMsEpoch($valueMsEpoch)
  {
    $this->valueMsEpoch = $valueMsEpoch;
  }
  public function getValueMsEpoch()
  {
    return $this->valueMsEpoch;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleAppsCardV1DateTimePicker::class, 'Google_Service_HangoutsChat_GoogleAppsCardV1DateTimePicker');
