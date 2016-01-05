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
               ->setContent($row['content'])
               ->setPublished((bool) $row['published'])
               ->setOrder((int) $row['order']);

        return $entity;
    }

    /**
     * Updates publication states by associated ids
     * 
     * @param array $pairs
     * @return boolean
     */
    public function updatePublishedStates(array $pairs)
    {
        foreach ($pairs as $id => $state) {
            if (!$this->testimonialMapper->updatePublishedById($id, $state)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Updates sorting order by associated ids
     * 
     * @param array $pairs
     * @return boolean
     */
    public function updateSortingOrders(array $pairs)
    {
        foreach ($pairs as $id => $order) {
            if (!$this->testimonialMapper->updateOrderById($id, $order)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Deletes testimonials by their associated ids
     * 
     * @param array $ids
     * @return boolean
     */
    public function deleteByIds(array $ids)
    {
        foreach ($ids as $id) {
            if (!$this->testimonialMapper->deleteById($id)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Deletes a testimonial by its associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->testimonialMapper->deleteById($id);
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
     * Updates a testimonial
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input)
    {
        return $this->testimonialMapper->update($input);
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
