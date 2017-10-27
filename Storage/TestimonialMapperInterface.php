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
     * Update settings
     * 
     * @param array $settings
     * @return boolean
     */
    public function updateSettings(array $settings);

    /**
     * Fetches author's name by their associated id
     * 
     * @param string $id
     * @return string
     */
    public function fetchAuthorById($id);

    /**
     * Fetches testimonial data by its associated id
     * 
     * @param string $id Testimonial id
     * @param boolean $withTranslations Whether to fetch translations or not
     * @return array
     */
    public function fetchById($id, $withTranslations);

    /**
     * Fetches all testimonials
     * 
     * @param boolean $published Whether to fetch only published ones
     * @return array
     */
    public function fetchAll($published);
}
