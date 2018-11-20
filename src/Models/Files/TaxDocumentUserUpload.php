<?php

namespace Bulldog\Strype\Models\Files;

use Bulldog\Strype\Models\File;

/**
 * Tax Document.
 */
class TaxDocumentUserUpload extends File
{
    public function __construct($file)
    {
        $this->file = $file;
        $this->purpose = 'tax_document_user_upload';
    }
}
