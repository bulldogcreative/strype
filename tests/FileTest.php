<?php

namespace Strype;

use Bulldog\Strype\Models\Files\BusinessLogo;
use Bulldog\Strype\Models\Files\CustomerSignature;
use Bulldog\Strype\Models\Files\DisputeEvidence;
use Bulldog\Strype\Models\Files\IdentityDocument;
use Bulldog\Strype\Models\Files\PciDocument;
use Bulldog\Strype\Models\Files\TaxDocumentUserUpload;

class FileTest extends TestCase
{
    public function testCreateBusinessLogoFile()
    {
        $fp = fopen('./tests/files/Blank.jpg', 'r');
        $logo = new BusinessLogo($fp);
        $this->assertEquals('business_logo', $logo->getPurpose());
        $this->assertInstanceOf('Bulldog\Strype\Models\Files\BusinessLogo', $logo);
    }

    // public function testCreateCustomerSignatureFile()
    // {
    //     $fp = fopen('./tests/files/Blank.jpg', 'r');
    //     $logo = new CustomerSignature($fp);
    //     $file = $this->strype->file()->create($logo, [], $this->id->get(12));
    //     $this->assertEquals('customer_signature', $file->purpose);
    // }

    // public function testCreateDisputeEvidenceFile()
    // {
    //     $fp = fopen('./tests/files/Blank.jpg', 'r');
    //     $logo = new DisputeEvidence($fp);
    //     $file = $this->strype->file()->create($logo, [], $this->id->get(12));
    //     $this->assertEquals('dispute_evidence', $file->purpose);
    // }

    // public function testCreateIdentityDocumentFile()
    // {
    //     $fp = fopen('./tests/files/Blank.jpg', 'r');
    //     $logo = new IdentityDocument($fp);
    //     $file = $this->strype->file()->create($logo, [], $this->id->get(12));
    //     $this->assertEquals('identity_document', $file->purpose);
    // }

    // public function testCreatePciDocumentFile()
    // {
    //     $fp = fopen('./tests/files/download.pdf', 'r');
    //     $logo = new PciDocument($fp);
    //     $file = $this->strype->file()->create($logo, [], $this->id->get(12));
    //     $this->assertEquals('pci_document', $file->purpose);
    // }

    // public function testCreateTaxDocumentUserUploadFile()
    // {
    //     $fp = fopen('./tests/files/Blank.jpg', 'r');
    //     $logo = new TaxDocumentUserUpload($fp);
    //     $file = $this->strype->file()->create($logo, [], $this->id->get(12));
    //     $this->assertEquals('tax_document_user_upload', $file->purpose);
    // }

    // public function testRetrieveFile()
    // {
    //     $fp = fopen('./tests/files/Blank.jpg', 'r');
    //     $logo = new TaxDocumentUserUpload($fp);
    //     $file = $this->strype->file()->create($logo, [], $this->id->get(12));
    //     $retrieved = $this->strype->file()->retrieve($file->getId());
    //     $this->assertEquals($file->size, $retrieved->size);
    // }

    public function testListAll()
    {
        $files = $this->strype->file()->listAll(['limit' => 1]);
        $this->assertEquals(1, count($files->data));
    }
}
