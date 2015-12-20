<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Testimonials\Service;

interface TestimonialManagerInterface
{
    /**
     * Returns last id
     * 
     * @return integer
     */
    public function getLastId();

    /**
     * Fetches all entities
     * 
     * @param boolean $published Whether to fetch only published ones
     * @return array
     */
    public function fetchAll($published);

    /**
     * Adds a testimonial
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function add(array $input);
}
