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

namespace Google\Service\DataLabeling;

class GoogleCloudDatalabelingV1beta1TimeSegment extends \Google\Model
{
  public $endTimeOffset;
  public $startTimeOffset;

  public function setEndTimeOffset($endTimeOffset)
  {
    $this->endTimeOffset = $endTimeOffset;
  }
  public function getEndTimeOffset()
  {
    return $this->endTimeOffset;
  }
  public function setStartTimeOffset($startTimeOffset)
  {
    $this->startTimeOffset = $startTimeOffset;
  }
  public function getStartTimeOffset()
  {
    return $this->startTimeOffset;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDatalabelingV1beta1TimeSegment::class, 'Google_Service_DataLabeling_GoogleCloudDatalabelingV1beta1TimeSegment');
