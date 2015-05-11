<?php
namespace PHPCommerce\Payment\Service\Gateway\Tests;

use PHPCommerce\Core\Payment\Dto\PaymentRequestDTO;
use PHPCommerce\Core\Payment\Service\PaymentGatewayReportingService;
use PHPCommerce\Vendor\Giropay\Service\Payment\GiropayConstants;

class GiropayReportingServiceIntegrationTest extends AbstractIntegrationTest {
    /**
     * @var PaymentGatewayReportingService
     */
    protected $giropayReportingService;

    public function setUp()
    {
        parent::setUp();
        $this->giropayReportingService = $this->container->get("pcGiropayReportingService");
    }

    protected function generatePaymentRequestDTO($reference) {
        $requestDTO = new PaymentRequestDTO();
        $requestDTO
            ->additionalField(GiropayConstants::GATEWAY_TRANSACTION_ID, $reference);

        return $requestDTO;
    }

    /**
     * @group liveTest
     */
    public function testRequestHostedEndpointLive() {
/*        $this->setMockResponse(
            $this->client, array('transaction-start.txt')
        );
*/
        $requestDTO = $this->generatePaymentRequestDTO("a07af793-3c0e-4ecb-a1f4-ede94ca2e678");

        $response = $this->giropayReportingService->findDetailsByTransaction($requestDTO);

        $this->assertInstanceOf("PHPCommerce\\Common\\Payment\\Dto\\PaymentResponseDTO", $response);

        $this->assertFalse($response->isSuccessful());

    }
}