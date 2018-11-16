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
    const TEST_RESOURCE_ID = 'file_123';

    public function testCreateBusinessLogoFile()
    {
        $fp = fopen('./tests/files/Blank.jpg', 'r');
        $logo = new BusinessLogo($fp);
        $this->assertEquals('business_logo', $logo->getPurpose());
        $this->assertInstanceOf('Bulldog\Strype\Models\Files\BusinessLogo', $logo);
    }

    public function testCreateCustomerSignatureFile()
    {
        $fp = fopen('./tests/files/Blank.jpg', 'r');
        $logo = new CustomerSignature($fp);
        $this->assertEquals('customer_signature', $logo->getPurpose());
        $this->assertInstanceOf('Bulldog\Strype\Models\Files\CustomerSignature', $logo);
    }

    public function testCreateDisputeEvidenceFile()
    {
        $fp = fopen('./tests/files/Blank.jpg', 'r');
        $logo = new DisputeEvidence($fp);
        $this->assertEquals('dispute_evidence', $logo->getPurpose());
        $this->assertInstanceOf('Bulldog\Strype\Models\Files\DisputeEvidence', $logo);
    }

    public function testCreateIdentityDocumentFile()
    {
        $fp = fopen('./tests/files/Blank.jpg', 'r');
        $logo = new IdentityDocument($fp);
        $this->assertEquals('identity_document', $logo->getPurpose());
        $this->assertInstanceOf('Bulldog\Strype\Models\Files\IdentityDocument', $logo);
    }

    public function testCreatePciDocumentFile()
    {
        $fp = fopen('./tests/files/Blank.jpg', 'r');
        $logo = new PciDocument($fp);
        $this->assertEquals('pci_document', $logo->getPurpose());
        $this->assertInstanceOf('Bulldog\Strype\Models\Files\PciDocument', $logo);
    }

    public function testCreateTaxDocumentUserUploadFile()
    {
        $fp = fopen('./tests/files/Blank.jpg', 'r');
        $logo = new TaxDocumentUserUpload($fp);
        $this->assertEquals('tax_document_user_upload', $logo->getPurpose());
        $this->assertInstanceOf('Bulldog\Strype\Models\Files\TaxDocumentUserUpload', $logo);
    }

    public function testRetrieveFile()
    {
        $this->expectsRequest(
            'get',
            '/v1/files/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->strype->file()->retrieve(self::TEST_RESOURCE_ID);
    }

    public function testListAll()
    {
        $files = $this->strype->file()->listAll(['limit' => 1]);
        $this->assertEquals(1, count($files->data));
    }
}
