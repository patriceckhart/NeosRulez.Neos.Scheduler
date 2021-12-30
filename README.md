# A Neos CMS package to easily manage cron-jobs.

NeosRulez.Neos.Scheduler adds a scheduler functionality to Neos CMS. Easily create recurring (cron jobs) or one-time scripts.

![Scheduler](https://raw.githubusercontent.com/patriceckhart/NeosRulez.Neos.Scheduler/master/Preview.gif)

## Installation

The NeosRulez.Neos.Scheduler is listed on packagist (https://packagist.org/packages/neosrulez/neos-scheduler) - therefore you don't have to include the package in your "repositories" entry any more.

Just run ```composer require neosrulez/neos-scheduler```

## Settings.yaml

```yaml
NeosRulez:
  Neos:
    Scheduler:
      frequencyInput: false
      templatePathAndFilename: 'resource://NeosRulez.Neos.Scheduler/Private/Templates/Mail/Task.html'
      senderMail: 'noreply@foo.com'
```

## Author

* E-Mail: mail@patriceckhart.com
* URL: http://www.patriceckhart.com
