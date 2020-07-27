<?php

namespace App\Service;

use App\Entity\Author;

class AuthorService extends AbstractService
{

    /**
     * Creates new Author entity
     * 
     * @param string $name
     * @return Author
     */
    public function create(string $name): Author
    {
        $author = new Author;
        $author->setName($name);

        $this->em->persist($author);
        $this->em->flush();

        return $author;
    }

}
