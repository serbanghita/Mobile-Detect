---
description: Welcome to the guide on how to use Mobile Detect PHP library in your project.
---

# 👋 Introduction

![Workflow status](https://img.shields.io/github/actions/workflow/status/serbanghita/Mobile-Detect/4.8.x-test.yml?style=flat-square)
![Latest tag](https://img.shields.io/github/v/tag/serbanghita/Mobile-Detect?filter=4.*&style=flat-square)
![Monthly Downloads](https://img.shields.io/packagist/dm/mobiledetect/mobiledetectlib?style=flat-square&label=installs)
![Total Downloads](https://img.shields.io/packagist/dt/mobiledetect/mobiledetectlib?style=flat-square&label=installs)
![MIT License](https://img.shields.io/packagist/l/mobiledetect/mobiledetectlib?style=flat-square)

### **What is it?**

Mobile Detect is a lightweight PHP package for detecting mobile devices (including tablets). \
It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment.

- MobileDetect class is a 
[server-side detection](http://www.w3.org/TR/mwabp/#bp-devcap-detection) PHP class that can help you with your RWD strategy, 
it is not a replacement for CSS3 media queries or other forms of client-side feature detection.
- Can detect the difference between a mobile phone and a tablet by using regexes.
- The **accuracy** and **relevance** of the detection is kept by running [tests](https://github.com/serbanghita/Mobile-Detect/tree/4.8.x/tests) to check for detection conflicts.

***

### **How does it work?**

MobileDetect class uses a list of regexes ordered by importance.

The regexes can be grouped as a `string` containing matching words separated by pipe: "`iPad|iPad.*Mobile`" or grouped into `arrays` of smaller strings sequences in order to avoid memory issues.

There are four types of regexes: `browsers`, `operatingSystems`, `mobile` and `tablet`.

All the regexes inside `MobileDetect.php` file refer to "mobile" devices, not "desktop" or other type of devices.

The library's main purpose is to detect "mobile" devices and attempt to figure out if the "mobile" device is a "phone" or a "tablet".
