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

final class SiteService implements SiteServiceInterface
{
    /**
     * The service object
     * 
     * @var \Testimonials\Service\TestimonialManagerInterface
     */
    private $testimonialManager;

    /**
     * State initialization
     * 
     * @param \Testimonials\Service\TestimonialManagerInterface $testimonialManager
     * @return void
     */
    public function __construct(TestimonialManagerInterface $testimonialManager)
    {
        $this->testimonialManager = $testimonialManager;
    }
}
