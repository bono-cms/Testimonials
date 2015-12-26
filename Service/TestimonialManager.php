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
use Krystal\Stdlib\VirtualEntity;

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

    /**
     * {@inheritDoc}
     */
    protected function toEntity(array $row)
    {
        $entity = new VirtualEntity();
        $entity->setId($row['id'])
               ->setAuthor($row['author'])
               ->setContent($row['content']);

        return $entity;
    }

    /**
     * Gets testimonial's entity by its associated id
     * 
     * @param string $id Testimonial id
     * @return \Krystal\Stdlib\VirtualEntity|boolean
     */
    public function fetchById($id)
    {
        return $this->prepareResult($this->testimonialMapper->fetchById($id));
    }

    /**
     * Returns last id
     * 
     * @return integer
     */
    public function getLastId()
    {
        return $this->testimonialMapper->getLastId();
    }

    /**
     * Fetches all entities
     * 
     * @param boolean $published Whether to fetch only published ones
     * @return array
     */
    public function fetchAll($published)
    {
        return $this->prepareResults($this->testimonialMapper->fetchAll($published));
    }

    /**
     * Adds a testimonial
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function add(array $input)
    {
        return $this->testimonialMapper->insert($input);
    }
}
