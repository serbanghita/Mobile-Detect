---
description: >-
  Learn how to create a port of Mobile Detect in a different language or
  library.
---

# 🌏 Extending / Porting

Open [https://github.com/serbanghita/Mobile-Detect/blob/4.8.x/MobileDetect.json](https://github.com/serbanghita/Mobile-Detect/blob/4.8.x/MobileDetect.json)

It contains all the information necessary to create a "mobile" detection script in any programming language. You can auto-import this periodically in your repository by checking the `version` property, which is updated on each release.

The following fields will help you create a Mobile Detect script in the language of your choice.

```json
{
    // Current released version. Respects semver.
    "version": "x.x.x",
    // Specific HTTP headers that attest for a "mobile" device.
    "headerMatch": { ... },
    // Array with HTTP header names that can potentially contain the "User-Agent" string.
    "uaHttpHeaders": [ ... ],
    // Amazon CloudFront headers.
    "cloudFrontHttpHeaders": [ ... ],
    // Regexes ordered by priority of "mobile" devices.
    "uaMatch": {
       "phones": { ... },
       "tablets": { ... },
       "browsers": { ... },
       "os": { ... }
    }
```

If you believe you need more fields or values, please [open a Github issue](https://github.com/serbanghita/Mobile-Detect/issues/new?assignees=serbanghita\&labels=feature\&projects=\&template=feature\_request.md\&title=%5Bfeature%5D).
