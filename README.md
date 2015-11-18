Online-CSR-Generator
====================

This is the public repository for [Online-CSR-Generator].
Online-CSR-Generator is a pretty simple PHP Webapp which generates Certificate Signing Request(CSR) for creating SSL certificates.
Actually, you can do it with OpenSSL via the command line interface.
This PHP Webapp is just designed for make it much easier.
After generating CSR, both of your CSR and private key will be sent to the email address you specified.

Environment:
- LAMP
- PEAR Packages ( Mail + Net_SMTP )

Installation
-------

### About needed PEAR Packages
	pear install Mail
	pear install Net_SMTP

License
-------

Copyright 2015 [guyusoftware]

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

[guyusoftware]: https://www.guyusoftware.com/
[Online-CSR-Generator]: https://www.guyusoftware.com/online_csr_generator/
