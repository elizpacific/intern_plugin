<?php

namespace TestMagento\TestPage\Api\Data;

interface TestInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const NAME            = 'name';
    const POST_CONTENT                 = 'post_content';
    const TAGS               = 'tags';
    const STATUS               = 'status';
    const CREATED_AT            = 'created_at';
    /**#@-*/


    /**
     * Get Title
     *
     * @return string|null
     */
    public function getName();

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getPostContent();

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set Title
     *
     * @param $name
     * @return $this
     */
    public function setName($name);

    /**
     * Set Content
     *
     * @param $post_content
     * @return $this
     */
    public function setPostContent($post_content);

    /**
     * Set Crated At
     *
     * @param int $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

}
