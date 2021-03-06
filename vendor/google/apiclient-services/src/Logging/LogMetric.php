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

namespace Google\Service\Logging;

class LogMetric extends \Google\Model
{
  protected $bucketOptionsType = BucketOptions::class;
  protected $bucketOptionsDataType = '';
  public $createTime;
  public $description;
  public $disabled;
  public $filter;
  public $labelExtractors;
  protected $metricDescriptorType = MetricDescriptor::class;
  protected $metricDescriptorDataType = '';
  public $name;
  public $updateTime;
  public $valueExtractor;
  public $version;

  /**
   * @param BucketOptions
   */
  public function setBucketOptions(BucketOptions $bucketOptions)
  {
    $this->bucketOptions = $bucketOptions;
  }
  /**
   * @return BucketOptions
   */
  public function getBucketOptions()
  {
    return $this->bucketOptions;
  }
  public function setCreateTime($createTime)
  {
    $this->createTime = $createTime;
  }
  public function getCreateTime()
  {
    return $this->createTime;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function setDisabled($disabled)
  {
    $this->disabled = $disabled;
  }
  public function getDisabled()
  {
    return $this->disabled;
  }
  public function setFilter($filter)
  {
    $this->filter = $filter;
  }
  public function getFilter()
  {
    return $this->filter;
  }
  public function setLabelExtractors($labelExtractors)
  {
    $this->labelExtractors = $labelExtractors;
  }
  public function getLabelExtractors()
  {
    return $this->labelExtractors;
  }
  /**
   * @param MetricDescriptor
   */
  public function setMetricDescriptor(MetricDescriptor $metricDescriptor)
  {
    $this->metricDescriptor = $metricDescriptor;
  }
  /**
   * @return MetricDescriptor
   */
  public function getMetricDescriptor()
  {
    return $this->metricDescriptor;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setUpdateTime($updateTime)
  {
    $this->updateTime = $updateTime;
  }
  public function getUpdateTime()
  {
    return $this->updateTime;
  }
  public function setValueExtractor($valueExtractor)
  {
    $this->valueExtractor = $valueExtractor;
  }
  public function getValueExtractor()
  {
    return $this->valueExtractor;
  }
  public function setVersion($version)
  {
    $this->version = $version;
  }
  public function getVersion()
  {
    return $this->version;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(LogMetric::class, 'Google_Service_Logging_LogMetric');
