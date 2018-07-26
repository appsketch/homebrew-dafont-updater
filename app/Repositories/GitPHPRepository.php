<?php

namespace Updater\Repositories;

use Cz\Git\GitRepository;

class GitPHPRepository extends GitRepository
{
    /**
     * Return all modified files as an array.
     */
    public function modified()
    {
        return $this->execute(array('ls-files', '--modified'));
    }
}
