<?php

namespace Bulldog\Strype\Models;

use Bulldog\Strype\Contracts\Models\FileTypeInterface;

/**
 * Base File class.
 */
abstract class File implements FileTypeInterface
{
    protected $file;
    protected $purpose;

    /**
     * Returns the stream resource.
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Returns the purpose of the file.
     *
     * @return string
     */
    public function getPurpose(): string
    {
        return $this->purpose;
    }
}
