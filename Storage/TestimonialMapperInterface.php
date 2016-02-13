<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Testimonials\Storage;

interface TestimonialMapperInterface
{
    /**
     * Fetches author's name by their associated id
     * 
     * @param string $id
     * @return string
     */
    public function fetchAuthorById($id);

    /**
     * Fetches all testimonials
     * 
     * @param boolean $published Whether to fetch only published ones
     * @return array
     */
    public function fetchAll($published);

    /**
     * Fetches a testimonial by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id);

    /**
     * Deletes a testimonial by its associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id);
}
