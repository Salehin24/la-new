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

namespace Google\Service\Blogger;

class Comment extends \Google\Model
{
  protected $authorType = CommentAuthor::class;
  protected $authorDataType = '';
  protected $blogType = CommentBlog::class;
  protected $blogDataType = '';
  public $content;
  public $id;
  protected $inReplyToType = CommentInReplyTo::class;
  protected $inReplyToDataType = '';
  public $kind;
  protected $postType = CommentPost::class;
  protected $postDataType = '';
  public $published;
  public $selfLink;
  public $status;
  public $updated;

  /**
   * @param CommentAuthor
   */
  public function setAuthor(CommentAuthor $author)
  {
    $this->author = $author;
  }
  /**
   * @return CommentAuthor
   */
  public function getAuthor()
  {
    return $this->author;
  }
  /**
   * @param CommentBlog
   */
  public function setBlog(CommentBlog $blog)
  {
    $this->blog = $blog;
  }
  /**
   * @return CommentBlog
   */
  public function getBlog()
  {
    return $this->blog;
  }
  public function setContent($content)
  {
    $this->content = $content;
  }
  public function getContent()
  {
    return $this->content;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getId()
  {
    return $this->id;
  }
  /**
   * @param CommentInReplyTo
   */
  public function setInReplyTo(CommentInReplyTo $inReplyTo)
  {
    $this->inReplyTo = $inReplyTo;
  }
  /**
   * @return CommentInReplyTo
   */
  public function getInReplyTo()
  {
    return $this->inReplyTo;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  /**
   * @param CommentPost
   */
  public function setPost(CommentPost $post)
  {
    $this->post = $post;
  }
  /**
   * @return CommentPost
   */
  public function getPost()
  {
    return $this->post;
  }
  public function setPublished($published)
  {
    $this->published = $published;
  }
  public function getPublished()
  {
    return $this->published;
  }
  public function setSelfLink($selfLink)
  {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink()
  {
    return $this->selfLink;
  }
  public function setStatus($status)
  {
    $this->status = $status;
  }
  public function getStatus()
  {
    return $this->status;
  }
  public function setUpdated($updated)
  {
    $this->updated = $updated;
  }
  public function getUpdated()
  {
    return $this->updated;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Comment::class, 'Google_Service_Blogger_Comment');
