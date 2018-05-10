**Known limitations**

* Mobile Detect script was designed to detect `mobile` devices. Implicitly other devices are considered to be `desktop`.
* User-Agent and HTTP headers sniffing is a non reliable method of detecting a mobile device.
* If the mobile browser is set on `Desktop mode`, the Mobile Detect script has no way of knowing that the device is `mobile`.
* Some touchscreen devices (eg. Microsoft Surface) are tough to detect as mobile since they can be used in a laptop mode.
* Detecting the device brand (eg. Apple, Samsung, HTC) is not 100% reliable.
* We don't monitor the quality of the 3rd party tools based on Mobile Detect script. 
We cannot guarantee that they are using the class properly or if they provide the latest version.
* Version `2.x` is made to be PHP 5.3 compatible because of the backward compatibility changes of PHP.
* There are hundreds of devices launched every month, we cannot keep a 100% up to date detection rate.