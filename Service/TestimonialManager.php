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

use Cms\Service\AbstractManager;
use Testimonials\Storage\TestimonialMapperInterface;

final class TestimonialManager extends AbstractManager implements TestimonialManagerInterface
{
    /**
     * Any compliant testimonial mapper
     * 
     * @var \Testimonials\Storage\TestimonialMapperInterface
     */
    private $testimonialMapper;

    /**
     * State initialization
     * 
     * @param \Testimonials\Storage\TestimonialMapperInterface $testimonialMapper
     * @return void
     */
    public function __construct(TestimonialMapperInterface $testimonialMapper)
    {
        $this->testimonialMapper = $testimonialMapper;
    }
}
