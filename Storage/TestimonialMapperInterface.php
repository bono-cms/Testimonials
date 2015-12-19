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
     * Fetches all testimonials
     * 
     * @param boolnean $published Whether to fetch only published ones
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
    public function deleteByPk($id);
}
