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

namespace Google\Service\Games;

class EventRecordRequest extends \Google\Collection
{
  protected $collection_key = 'timePeriods';
  public $currentTimeMillis;
  public $kind;
  public $requestId;
  protected $timePeriodsType = EventPeriodUpdate::class;
  protected $timePeriodsDataType = 'array';

  public function setCurrentTimeMillis($currentTimeMillis)
  {
    $this->currentTimeMillis = $currentTimeMillis;
  }
  public function getCurrentTimeMillis()
  {
    return $this->currentTimeMillis;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  public function setRequestId($requestId)
  {
    $this->requestId = $requestId;
  }
  public function getRequestId()
  {
    return $this->requestId;
  }
  /**
   * @param EventPeriodUpdate[]
   */
  public function setTimePeriods($timePeriods)
  {
    $this->timePeriods = $timePeriods;
  }
  /**
   * @return EventPeriodUpdate[]
   */
  public function getTimePeriods()
  {
    return $this->timePeriods;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(EventRecordRequest::class, 'Google_Service_Games_EventRecordRequest');
