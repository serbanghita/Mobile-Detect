---
description: Welcome to the guide on how to use Mobile Detect PHP library in your project.
---

# 👋 Introduction

## **What is it?**

Mobile Detect is a lightweight PHP package for detecting mobile devices (including tablets). \
It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment.

***

## **How does it work?**

MobileDetect class uses a list of regexes ordered by importance.

The regexes can be grouped as a `string` containing matching words separated by pipe: "`iPad|iPad.*Mobile`" or grouped into `arrays` of smaller strings sequences in order to avoid memory issues.

There are four types of regexes: `browsers`, `operatingSystems`, `mobile` and `tablet`.

All the regexes inside `MobileDetect.php` file refer to "mobile" devices, not "desktop" or other type of devices.

The library's main purpose is to detect "mobile" devices and attempt to figure out if the "mobile" device is a "phone" or a "tablet".
