<?php
namespace MobileDetect\Service;

use MobileDetect\Device\DeviceType;
use MobileDetect\Matcher\Matcher;
use MobileDetect\Repository\Device\DeviceInterface;
use MobileDetect\Repository\Device\DeviceRepository;

class DetectDeviceService extends AbstractService
{
    public function detect()
    {
        $result = $this->getResult();

        // Search phone database.
        $phoneRepo = new DeviceRepository(new \stdClass());
        $phone = $phoneRepo->matchByUserAgent($result->getUserAgent());
        if ($phone instanceof DeviceInterface) {
            $result->setDevice($phone);
            $result->getDevice()->setType(DeviceType::MOBILE);
        }

        // Search tablet database. Override device info if found.
        $tabletRepo = new DeviceRepository(new \stdClass());
        $tablet = $tabletRepo->matchByUserAgent($result->getUserAgent());
        if ($tablet instanceof DeviceInterface) {
            $result->setDevice($tablet);
            $result->getDevice()->setType(DeviceType::TABLET);
        }

        // If we know the device,
        // get model and version of the physical device (if possible).
        if ($result->getDevice() instanceof DeviceInterface) {
            if (is_null($result->getDevice()->getModel())) {
                // Attempt to detect model and model version.
                $modelAndVersion = Matcher::matchModelAndVersion(
                    $result->getDevice()->getMatchModelAndVersion(),
                    $result->getUserAgent()
                );
                if ($modelAndVersion) {
                    if (isset($modelAndVersion['model'])) {
                        $result->getDevice()->setModel($modelAndVersion['model']);
                    }
                    if (isset($modelAndVersion['version'])) {
                        $result->getDevice()->setVersion($modelAndVersion['version']);
                    }
                }
            }
            return true;
        }

        return false;
    }
}