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

final class SiteService
{
    /**
     * The service object
     * 
     * @var \Testimonials\Service\TestimonialManager
     */
    private $testimonialManager;

    /**
     * State initialization
     * 
     * @param \Testimonials\Service\TestimonialManager $testimonialManager
     * @return void
     */
    public function __construct(TestimonialManager $testimonialManager)
    {
        $this->testimonialManager = $testimonialManager;
    }

    /**
     * Returns all published testimonial entities
     * 
     * @return array
     */
    public function getAll()
    {
        return $this->testimonialManager->fetchAll(true);
    }
}
