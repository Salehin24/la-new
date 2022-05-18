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

namespace Google\Service\Dataflow;

class StreamingComputationConfig extends \Google\Collection
{
  protected $collection_key = 'instructions';
  public $computationId;
  protected $instructionsType = ParallelInstruction::class;
  protected $instructionsDataType = 'array';
  public $stageName;
  public $systemName;
  public $transformUserNameToStateFamily;

  public function setComputationId($computationId)
  {
    $this->computationId = $computationId;
  }
  public function getComputationId()
  {
    return $this->computationId;
  }
  /**
   * @param ParallelInstruction[]
   */
  public function setInstructions($instructions)
  {
    $this->instructions = $instructions;
  }
  /**
   * @return ParallelInstruction[]
   */
  public function getInstructions()
  {
    return $this->instructions;
  }
  public function setStageName($stageName)
  {
    $this->stageName = $stageName;
  }
  public function getStageName()
  {
    return $this->stageName;
  }
  public function setSystemName($systemName)
  {
    $this->systemName = $systemName;
  }
  public function getSystemName()
  {
    return $this->systemName;
  }
  public function setTransformUserNameToStateFamily($transformUserNameToStateFamily)
  {
    $this->transformUserNameToStateFamily = $transformUserNameToStateFamily;
  }
  public function getTransformUserNameToStateFamily()
  {
    return $this->transformUserNameToStateFamily;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(StreamingComputationConfig::class, 'Google_Service_Dataflow_StreamingComputationConfig');
