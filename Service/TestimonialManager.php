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
use Cms\Service\HistoryManagerInterface;
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
     * History manager to keep tracks
     * 
     * @var \Cms\Service\HistoryManagerInterface
     */
    private $historyManager;

    /**
     * State initialization
     * 
     * @param \Testimonials\Storage\TestimonialMapperInterface $testimonialMapper
     * @param \Cms\Service\HistoryManagerInterface $historyManager
     * @return void
     */
    public function __construct(TestimonialMapperInterface $testimonialMapper, HistoryManagerInterface $historyManager)
    {
        $this->testimonialMapper = $testimonialMapper;
        $this->historyManager = $historyManager;
    }

    /**
     * Tracks activity
     * 
     * @param string $message
     * @param string $placeholder
     * @return boolean
     */
    private function track($message, $placeholder)
    {
        return $this->historyManager->write('Testimonials', $message, $placeholder);
    }

    /**
     * {@inheritDoc}
     */
    protected function toEntity(array $row)
    {
        $entity = new VirtualEntity();
        $entity->setId($row['id'], VirtualEntity::FILTER_INT)
               ->setAuthor($row['author'], VirtualEntity::FILTER_HTML)
               ->setContent($row['content'], VirtualEntity::FILTER_HTML)
               ->setPublished($row['published'], VirtualEntity::FILTER_BOOL)
               ->setOrder($row['order'], VirtualEntity::FILTER_INT);

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

        $this->track('%s testimonials have been removed', count($ids));
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
        $author = $this->testimonialMapper->fetchAuthorById($id);

        if ($this->testimonialMapper->deleteById($id)) {
            $this->track('A testimonial by %s has been removed', $author);
            return true;
        } else {
            return false;
        }
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
        $input['order'] = (int) $input['order'];

        $this->track('The testimonial by %s has been updated', $input['author']);
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
        $input['order'] = (int) $input['order'];

        $this->track('A testimonial by %s has been added', $input['author']);
        return $this->testimonialMapper->insert($input);
    }
}
