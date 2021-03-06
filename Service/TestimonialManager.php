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

final class TestimonialManager extends AbstractManager
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
        $entity->setId($row['id'], VirtualEntity::FILTER_INT)
               ->setLangId($row['lang_id'], VirtualEntity::FILTER_INT)
               ->setAuthor($row['author'], VirtualEntity::FILTER_HTML)
               ->setContent($row['content'], VirtualEntity::FILTER_HTML)
               ->setPublished($row['published'], VirtualEntity::FILTER_BOOL)
               ->setOrder($row['order'], VirtualEntity::FILTER_INT);

        return $entity;
    }

    /**
     * Update settings
     * 
     * @param array $settings
     * @return boolean
     */
    public function updateSettings(array $settings)
    {
        return $this->testimonialMapper->updateSettings($settings);
    }

    /**
     * Updates a testimonial
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function save(array $input)
    {
        $input['testimonial']['order'] = (int) $input['testimonial']['order'];
        return $this->testimonialMapper->saveEntity($input['testimonial'], $input['translation']);
    }

    /**
     * Deletes a testimonial by its associated id
     * 
     * @param string|array $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->testimonialMapper->deleteEntity($id);
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
     * Gets testimonial's entity by its associated id
     * 
     * @param string $id Testimonial id
     * @param boolean $withTranslations Whether to fetch translations or not
     * @return \Krystal\Stdlib\VirtualEntity|boolean
     */
    public function fetchById($id, $withTranslations)
    {
        if ($withTranslations == true) {
            return $this->prepareResults($this->testimonialMapper->fetchById($id, true));
        } else {
            return $this->prepareResult($this->testimonialMapper->fetchById($id, false));
        }
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
}
