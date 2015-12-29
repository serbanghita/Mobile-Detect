<?php
namespace MobileDetect\Service;

use MobileDetect\Context;
use MobileDetect\Device\DeviceType;
use MobileDetect\Matcher\Matcher;
use MobileDetect\Repository\Device\DeviceInterface;
use MobileDetect\Repository\Device\DeviceRepository;

class DetectDeviceService
{
    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    protected function getContext()
    {
        return $this->context;
    }

    public function detect()
    {
        $device = null;
        $context = $this->getContext();

        // Search phone database.
        // Save the device type in Context.
        $phoneRepo = new DeviceRepository(new \stdClass(), $context);
        $phone = $phoneRepo->search();
        if ($phone) {
            $context->setDeviceType(DeviceType::MOBILE);
            $device = $phone;
        }

        // Search tablet database. Override device info if found.
        // Save the device type in Context.
        $tabletRepo = new DeviceRepository(new \stdClass(), $context);
        $tablet = $tabletRepo->search();
        if ($tablet) {
            $context->setDeviceType(DeviceType::TABLET);
            $device = $tablet;
        }

        // If we know the device,
        // get model and version of the physical device (if possible).
        if ($device instanceof DeviceInterface) {
            $this->context->setDevice($device);

            if (!is_null($device->getModel())) {
                // Device model is already known from the DB.
                $context->setDeviceModel($device->getModel());
            } else {
                // Attempt to detect model and model version.
                $modelAndVersion = Matcher::matchModelAndVersion(
                    $device->getMatchModelAndVersion(),
                    $context->getUserAgent()
                );
                if ($modelAndVersion) {
                    if (isset($modelAndVersion['model'])) {
                        $this->context->setDeviceModel($modelAndVersion['model']);
                    }
                    if (isset($modelAndVersion['version'])) {
                        $this->context->setDeviceModelVersion($modelAndVersion['version']);
                    }
                }
            }

            return true;
        }

        return false;
    }
}